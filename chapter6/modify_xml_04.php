<?php

$xml = simplexml_load_file('books.xml');

foreach ($xml->book as $book) {
	$distributor = $book->addChild('distributor');
	$distributor->addChild('company', 'ABC Press');
	$distributor->addChild('location', 'New York, NY');
	$distributor->addChild('code');
}

header('Content-Type: text/xml');
echo $xml->asXML();