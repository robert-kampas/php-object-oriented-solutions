<?php

$books = simplexml_load_file('books.xml', 'SimpleXMLIterator');
$moreBooks = simplexml_load_file('more-books.xml', 'SimpleXMLIterator');

$combined = new AppendIterator();
$combined->append($books);
$combined->append($moreBooks);

/*
echo '<ol>';
foreach ($combined as $book) {
	echo "<li>$book->title";
	$authors = new CachingIterator($book->author);
	echo '<ul><li>';
	foreach ($authors as $name) {
		echo $name;
		if ($authors->hasNext()) {
			echo ', ';
		}
	}
	echo '</li></ul></li>';
}
echo '</ol>';
*/

echo '<ol>';
foreach ($combined as $book) {
	echo "<li>$book->title";
	$moreThan3 = false;

	if ($book->author->count() > 3) {
		$limit3 = new LimitIterator($book->author, 0, 3);
		$authors = new CachingIterator($limit3);
		$moreThan3 = true;
	} else {
		$authors = new CachingIterator($book->author);
	}

	echo '<ul><li>';
	foreach ($authors as $name) {
		echo $name;
		if ($authors->hasNext()) {
			echo ', ';
		}
	}

	if ($moreThan3) {
		echo ' el al.';
	}

	echo '</li></ul></li>';
}
echo '</ol>';