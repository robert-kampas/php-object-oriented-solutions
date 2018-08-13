<?php

require_once 'Pos_MysqlImprovedConnection.php';
require_once 'Pos_MysqlImprovedResult.php';

try {
	$conn = new Pos_MysqlImprovedConnection('localhost', 'root', 'rootpass', 'oop');
	$result = $conn->getResultSet('SELECT * FROM blog LIMIT 5');

	foreach (new LimitIterator($result, 0, 1) as $row) {
		foreach ($row as $field => $value) {
			if ($field === 'ID') {
				echo "$field: $value<br>";
			}
		}
		echo '<br>';
	}

	echo '<p><strong>This is outside both loops.</strong></p>';
	

	foreach (new LimitIterator($result, 1, 3) as $row) {
		foreach ($row as $field => $value) {
			if ($field === 'ID') {
				echo "$field: $value<br>";
			}
		}
		echo '<br>';
	}	
} catch (RuntimeException $e) {
	echo 'This is a RuntimeException: ' . $e->getMessage();
} catch (Exception $e) {
	echo 'This is an ordinary Exception: ' . $e->getMessage();
}