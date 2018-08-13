<?php

class Pos_XmlExporter
{
	protected $_dbLink;
	protected $_sql;
	protected $_docRoot;
	protected $_element;
	protected $_primaryKey;
	protected $_xmlFile;
	protected $_indent;
	protected $_indentString;

	public function __construct($server, $username, $password, $database)
	{
		if (!class_exists('XMLWriter')) {
			throw new Exception('Pos_XmlExporter requires the PHP core class XMLWriter.');
		}

		if (!class_exists('mysqli')) {
			throw new Exception('MySQL Improved not installed. Check PHP configuration and MySQL version.');
		}

		$this->_dbLink = new Pos_MysqlImprovedConnection($server, $username, $password, $database);	
	}

	public function setQuery($sql) {
		$this->_sql = $sql;
	}

	public function setTagNames($docRoot, $element)
	{
		$this->_docRoot = $this->checkValidName($docRoot);
		$this->_element = $this->checkValidName($element);
	}

	protected function checkValidName($name)
	{
		if (preg_match('/^[\d\.-]/', $name)) {
			throw new RuntimeException('XML names cannot begin with a number, period, or hyphen.');
		}

		if (preg_match('/^xml/i', $name)) {
			throw new RuntimeException('XML names cannot begin with "xml".');
		}		

		if (preg_match('/:/', $name)) {
			throw new RuntimeException('Colons are permitted only in a namespace prefix. Pos_XmlExporter does not support namespaces.');
		}			

		return $name;
	}

	public function usePrimaryKey($table)
	{
		$getIndex = $this->_dbLink->getResultSet("SHOW INDEX FROM $table");

		foreach ($getIndex as $row) {
			$this->_primaryKey[] = $row['Column_name'];
		}
	}

	public function setFilePath($pathname, $indent = true, $indentString = "\t")
	{
		$this->_xmlFile = $pathname;
		$this->_indent = $indent;
		$this->_indentString = $indentString;
	}

	public function generateXML()
	{
		// Step 1: Check that the SQL query has been defined
		if (!isset($this->_sql)) {
			throw new LogicException('No SQL query defined! Use setQuery() before calling generateXML().');
		}

		// Submit the query to the database
		$resultSet = $this->_dbLink->getResultSet($this->_sql);

		// Step 2: Check first row of result for valid field names
		foreach (new LimitIterator($resultSet, 0, 1) as $row) {
			foreach ($row as $field => $value) {
				$this->checkValidName($field);
			}
		}

		// Step 3: Set root and top-level node names
		$this->_docRoot = isset($this->_docRoot) ? $this->_docRoot : 'root';
		$this->_element = isset($this->_element) ? $this->_element : 'row';

		// Step 4: Set a Boolean flag to insert primary key as attribute
		$usePK = (isset($this->_primaryKey) && !empty($this->_primaryKey));

		// Step 5: Generate and output XML
		// Instantiate an XMLWriter object
		$xml = new XMLWriter();

		// Set the output preferences
		if (isset($this->_xmlFile)) {
			// Open the output file
			$fileOpen = @$xml->openUri($this->_xmlFile);

			if (!$fileOpen) {
				throw new RuntimeException("Cannot create $this->_xmlFile. Check permissions and that target folder exists");
			} else {
				// Set indentation preferences
				$xml->setIndent($this->_indent);
				$xml->setIndentString($this->_indentString);
			}
		} else {
			// If the output is being sent to a string, open memory instead
			$xml->openMemory();
		}

		// Start the document and create the root element
		$xml->startDocument();
		$xml->startElement($this->_docRoot);

		// Loop through each row of the database result set
		foreach ($resultSet as $row) {
			// Create the opening tag of the top-level node
			$xml->startElement($this->_element);
			// Add the primary key(s) as attribute(s)
			if ($usePK) {
				foreach ($this->_primaryKey as $pk) {
					$xml->writeAttribute($pk, $row[$pk]);
				}
			}

			// Inside each row, loop through each field
			foreach ($row as $field => $value) {
				// Skip the primary key(s) if used as attribute(s)
				if ($usePK && in_array($field, $this->_primaryKey)) {
					continue;
				}
				// Create child node for each field
				$xml->writeElement($field, $value);
			}
			// Create the closing tag for the top-level node
			$xml->endElement();
		}

		// Create the closing tag for the root element
		$xml->endElement();
		// Close the XML document
		$xml->endDocument();

		// Output the genrated XML
		return $xml->flush();
	}
}