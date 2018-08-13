<?php

$xml = simplexml_load_file('books.xml');

foreach ($xml->book as $book) {
	unset($book['id']);
	unset($book->price);
	unset($book->description);
}

header('Content-Type: text/xml');
echo $xml->asXML();