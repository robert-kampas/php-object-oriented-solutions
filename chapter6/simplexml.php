<?php

$xml = simplexml_load_file('books.xml');

//echo '<pre>';
//print_r($xml);

foreach ($xml->book as $book) {
	echo $book->title . ' (ID: ' . $book['id'] . ')<br>';
}

echo '<hr>';

// Get element nodes at the top level of the XML document
$children = $xml->children();
// Loop though each top level node to display its name
foreach ($children as $child) {
	echo 'Node name: ' . $child->getName() . '<br>';
	// Get the attributes for the current node
	$attributes = $child->attributes();
	// Loop though the attributes of the current node
	foreach ($attributes as $attribute) {
		echo 'Attribute ' . $attribute->getName() . ": $attribute<br>";
	}
	// If the current node has no children, display its value
	if (false === $nextChildren = $child->children()) {
		echo '$child<br>';
	} else {
		// Otherwise loop through the next level
		foreach ($nextChildren as $nextChild) {
			echo $nextChild->getName() . ": $nextChild<br>";
		}
		echo '<br>';
	}
}

echo '<hr>';

foreach ($xml->book as $book) {
	echo '<h2>' . $book->title . '</h2>';

	echo '<p>';

	$num_authors = count($book->author);	
	for ($i = 0; $i < $num_authors; $i++) {
		echo $book->author[$i];

		// If there's only one author break out of loop
		if ($num_authors == 1) {
			break;
		} elseif ($i < ($num_authors - 2)) {
			// If there are more authrors left use a coma
			echo ', ';
		} elseif ($i == ($num_authors - 2)) {
			// Oterwise insert ampersand
			echo ' &amp; ';
		}
	}

	echo '</p>';
	echo '<p>' . $book->publisher . '</p>';
	echo '<p>ID: ' . $book['id'] . '</p>';
	echo '<p>' . $book->description . '</p>';

//var_dump($book->price->children());
//var_dump(count($book->price->children()));

	if (isset($book->price)) {
		if (count($book->price->children()) > 1) {
			foreach ($book->price->children() as $key => $value) {
				echo '<p>' . $key .': $' . $value .'</p>';
			}
		} else {
			echo '<p>Price: $' . $book->price . '</p>';
		}
	}
}