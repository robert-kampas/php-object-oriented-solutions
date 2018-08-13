<?php

/*
$xml = simplexml_load_file('books.xml');
header('Content-Type: text/xml');
echo $xml->asXML();
*/

/*
$xml = simplexml_load_file('books.xml');
if ($xml->asXML('books-copy.xml')) {
	echo 'XML saved';
} else {
	echo 'Could not save XML.';
}
*/

/*
$xml = simplexml_load_file('books.xml');
if ($xml->book[1]->asXML('books-book1.xml')) {
	echo 'XML saved';
} else {
	echo 'Could not save XML.';
}
*/

$xml = simplexml_load_file('books.xml');
$output = "<?xml version='1.0' encoding='utf-8'?>\n";
$output .= $xml->book[1]->asXML();

if (file_put_contents('books-1-xml.xml', $output)) {
	echo 'XML saved';
} else {
	echo 'Could not save XML.';
}