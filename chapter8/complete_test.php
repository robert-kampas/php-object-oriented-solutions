<?php

require_once 'Pos_MysqlImprovedConnection.php';
require_once 'Pos_MysqlImprovedResult.php';
require_once 'Pos_XmlExporter.php';

try {
	$xml = new Pos_XmlExporter('localhost', 'root', 'rootpass', 'oop');
	$xml->setQuery('SELECT * FROM blog ORDER BY `ID` DESC LIMIT 5');
	$xml->setTagNames('blog', 'entry');
	$xml->usePrimaryKey('blog');
	$xml->setFilePath('output/blog.xml');
	$output = $xml->generateXML();
	//header('Content-Type: text/xml');
	//echo $output;

	if ($output === 0) {
		echo 'XML file saved.';
	} else {
		echo 'A problem has occured.';
	}
} catch (LogicException $e) {
	echo 'This is a LogicException: ' . $e->getMessage();	
} catch (RuntimeException $e) {
	echo 'This is a RuntimeException: ' . $e->getMessage();
} catch (Exception $e) {
	echo 'This is an ordinary Exception: ' . $e->getMessage();
}