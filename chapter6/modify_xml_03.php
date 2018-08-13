<?php

$xml = simplexml_load_file('books.xml');

foreach ($xml->book as $book) {
	if (strpos($book->title, 'XML') !== false) {
		$book->addAttribute('category', 'XML');
	} else {
		$book->addAttribute('category', 'Web design');
	}
}

header('Content-Type: text/xml');
echo $xml->asXML();