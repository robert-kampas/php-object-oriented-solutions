<?php

$xml = simplexml_load_file('books.xml');

foreach ($xml->book as $book) {
	$discounted_price = $book->price * 0.9;
	$book->price = number_format($discounted_price, 2);
}
header('Content-Type: text/xml');
echo $xml->asXML();