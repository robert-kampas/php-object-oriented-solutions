<?php

$connection = new mysqli('localhost', 'root', 'rootpass', 'oop');
$result = $connection->query('SELECT * FROM blog LIMIT 5');

foreach ($result as $row) {
	foreach ($row as $field => $value) {
		echo "$value<br>";
	}
	echo '<br>';
}

echo '<hr>';

foreach ($result as $row) {
	foreach ($row as $field => $value) {
		echo "$value<br>";
	}
	echo '<br>';
}