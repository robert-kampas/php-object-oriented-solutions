<?php

$books = simplexml_load_file('books.xml', 'SimpleXMLIterator');
$moreBooks = simplexml_load_file('more-books.xml', 'SimpleXMLIterator');

/*
$combined = new AppendIterator();
$combined->append($books);
$combined->append($moreBooks);

echo '<ol>';
foreach ($combined as $book) {
	echo "<li>$book->title</li>";
}
echo '</ol>';
*/

$limit1 = new LimitIterator($books, 0, 2);
$limit2 = new LimitIterator($moreBooks, 0, 2);

$combined = new AppendIterator();
$combined->append($limit1);
$combined->append($limit2);

echo '<ol>';
foreach ($combined as $book) {
	echo "<li>$book->title</li>";
}
echo '</ol>';