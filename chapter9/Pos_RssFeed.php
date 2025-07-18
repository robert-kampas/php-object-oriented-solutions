<?php

require_once '../chapter8/Pos_XmlExporter.php';
require_once '../chapter9/Pos_Utils.php';

class Pos_RssFeed extends Pos_XmlExporter
{
	protected $_feedTitle;
	protected $_feedLink;
	protected $_feedDescription;
	protected $_useNow;
	protected $_itemArray;
	protected $_numSentences;
	protected $_tableName;
	protected $_maxRecords;
	protected $_itemPubDate;
	protected $_itemLink;
	protected $_useURL;

	public function setFeedTitle($title)
	{
		$this->_feedTitle = $title;
	}

	public function setFeedLink($link)
	{
		$this->_feedLink = $link;
	}

	public function setFeedDescription($description)
	{
		$this->_feedDescription = $description;
	}

	public function setLastBuildDate($useNow = true)
	{
		$this->_useNow = $useNow;
	}

	public function setItemTitle($columnName)
    {
        $this->_itemArray['title'] = $columnName;
    }

    public function setItemDescription($columnName, $numSentences = 2)
    {
        $this->_itemArray['description'] = $columnName;
        $this->_numSentences = $numSentences;
    }

    public function setItemPubDate($columnName, $type = 'MySQL')
    {
        $this->_itemPubDate = $columnName;
        $rssFormat = '%a, %d %b %Y %H:%i:%S';

        if (stripos($type, 'MySQL') === false) {
            $this->_itemArray['pubDate'] = "FROM_UNIXTIME($columnName, '$rssFormat')";
        } else {
            $this->_itemArray['pubDate'] = "DATE_FORMAT($columnName, '$rssFormat')";
        }
    }

    public function setItemLink($columnName)
    {
        if (isset($this->_useURL)) {
            throw new LogicException('The methods setItemLink() and setItemLinkURL() are mutually exclusive. Use one or the other.');
        }

        $this->_itemArray['link'] = $columnName;
        $this->_useURL = false;
    }

    public function setItemLinkURL($url)
    {
        if (isset($this->_useURL)) {
            throw new LogicException('The methods setItemLink() and setItemLinkURL() are mutually exclusive. Use one or the other.');
        }

        if (!isset($this->_tableName)) {
            throw new LogicException('You must set the table name with setTable() before calling setItemLinkURL().');
        }

        parent::usePrimaryKey($this->_tableName);

        if (is_array($this->_primaryKey)) {
            $this->_primaryKey = $this->_primaryKey[0];
        } else {
            throw new RuntimeException("Cannot determine primary key for $this->_tableName.");
        }

        $this->_itemArray['link'] = $this->_primaryKey;
        $this->_itemLink = $url . "?$this->_primaryKey=";
        $this->_useURL = true;
    }

    public function usePrimaryKey($table = null) {}

    public function setTable($tableName, $maxRecords = 15)
    {
        $this->_tableName = $tableName;
        $this->_maxRecords = is_numeric($maxRecords) ? (int) abs($maxRecords) : 15;
    }

	public function generateXML()
	{
		$error = array();

		if (!isset($this->_feedTitle)) {
			$error[] = 'feed title';
		}

		if (!isset($this->_feedLink)) {
			$error[] = 'feed link';
		}		

		if (!isset($this->_feedDescription)) {
			$error[] = 'feed description';
		}		

		if ($error) {
			throw new LogicException('Cannot generate RSS feed. Check the following item(s): ' . implode(', ', $error) . '.');
		}		

		if (is_null($this->_sql)) {
		    $this->buildSQL();
        }

        $resultSet = $this->_dbLink->getResultSet($this->_sql);

		if ($this->_useNow) {
			$setLastBuildDate = date(DATE_RSS);
		} else {
		    foreach (new LimitIterator($resultSet, 0, 1) as $row) {
		        $setLastBuildDate = $row['pubDate'];
            }
        }

		$rss = new XMLWriter();
		
		if (isset($this->_xmlFile)) {
			$fileOpen = @$rss->openUri($this->_xmlFile);

			if (!$fileOpen) {
				throw new RuntimeException("Cannot create $this->_xmlFile. Check permissions and that target folder exists.");
			}

			$rss->setIndent($this->_indent);
			$rss->setIndentString($this->_indentString);
		} else {
			$rss->openMemory();
		}

		$rss->startDocument();
		$rss->startElement('rss');
		$rss->writeAttribute('version', '2.0');
		$rss->startElement('channel');
		$rss->writeElement('title', $this->_feedTitle);
		$rss->writeElement('link', $this->_feedLink);
		$rss->writeElement('description', $this->_feedDescription);
		$rss->writeElement('lastBuildDate', $setLastBuildDate);
		$rss->writeElement('docs', 'http://www.rssboard.org/rss-specification');

		// Code to generate <item> elements goes here
        foreach ($resultSet as $row) {
            $rss->startElement('item');

            foreach ($row as $field => $value) {
                if ($field == 'pubDate') {
                    $value = $this->getTimezoneOffset($value);
                } elseif ($field == 'link' && $this->_useURL) {
                    $value = $this->_itemLink . $value;
                } elseif ($field == 'description') {
                    $extract = Pos_Utils::getFirst($value, $this->_numSentences);
                    $value = $extract[0];
                }

                $rss->writeElement($field, $value);
            }

            $rss->endElement();
        }
		
		$rss->endElement();
		$rss->endElement();
		$rss->endDocument();

		return $rss->flush();
	}

	protected function buildSQL()
    {
        if (!isset($this->_tableName)) {
            throw new LogicException('No table defined. Use setTable().');
        }

        if (!isset($this->_itemArray['description']) && !isset($this->_itemArray['title'])) {
            throw new LogicException('RSS items must have at least a description or a title.');
        }

        // Initialise an empty array for the column names
        $select = array();

        // Loop through the $_itemArray property to build the list of aliases
        foreach ($this->_itemArray as $alias => $column) {
            $select[] = "$column AS $alias";
        }

        // Join the column/alias pairs as a comma-delimited string
        $select = implode(', ', $select);

        // Build the SQL
        $this->_sql = "SELECT $select FROM $this->_tableName ORDER BY $this->_itemPubDate ASC";

        // Add a LIMIT clause if $_maxRecords is not 0
        if ($this->_maxRecords) {
            $this->_sql .= " LIMIT $this->_maxRecords";
        }

        // Display the SQL for testing purposes
        //echo $this->_sql;
    }

    protected function getTimezoneOffset($pubDate)
    {
        if (class_exists('DateTime')) {
            $date = new DateTime($pubDate);

            return $date->format(DATE_RSS);
        } else {
            return $pubDate;
        }
    }
}
