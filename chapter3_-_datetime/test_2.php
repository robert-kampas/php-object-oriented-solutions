<?php

require_once 'Pos/Date.php';

try {
	$local = new Pos_Date();
	echo '<p>Time now: ' . $local->format('F jS, Y h:i A') . '</p>';

	$local->setTime(12, 30);
	$local->setDate(2008, 8, 8);
	echo '<p>Date and time reset: ' . $local->format('F jS, Y h:i A') . '</p>';

	$local->modify();
} catch (Exception $e) {
	echo $e;
}