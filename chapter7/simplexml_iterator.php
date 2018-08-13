<?php

$xml  = file_get_contents('books.xml');
$iterator = new SimpleXMLIterator($xml);

//var_dump($iterator);

$xml = simplexml_load_file('books.xml', 'SimpleXMLIterator');

$limiter = new LimitIterator($xml, 2, 3);
foreach ($limiter as $book) {
	echo $book->title . '<br>';
}