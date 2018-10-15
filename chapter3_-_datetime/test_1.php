<?php

require_once 'Pos/Date.php';

try {
	$local = new Pos_Date();
	echo '<p>Local time: ' . $local->format('F jS, Y h:i A') . '</p>';

	$timezone = new DateTimeZone('Asia/Tokyo');
	$tokyo = new Pos_Date($timezone);
	echo '<p>Tokyo time: ' . $tokyo->format('F jS, Y h:i A') . '</p>';
} catch (Exception $e) {
	echo $e;
}