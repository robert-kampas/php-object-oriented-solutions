<?php

require_once 'Pos/Date.php';

try {
	$start = new Pos_Date();
	$start->setDate(1999, 1, 1);

	$end = new Pos_Date();
	$end->setDate(2019, 1, 1);

	echo Pos_Date::dateDiff($start, $end) . ' days to go.';

	echo '<hr>';

	$initialDate = new Pos_Date();
	$initialDate->setDate(1999, 1, 1);

	$end = new Pos_Date();
	$end->setDate(2019, 1, 1);

	echo $initialDate->dateDiffAlternative($end) . ' days have passed.';

	echo '<hr>';

	echo new Pos_Date();

	echo '<hr>';
	echo '<p>' . $initialDate->getMDY() . '</p>';
	echo '<p>' . $initialDate->MDY . '</p>';
	echo '<p>' . $initialDate->mysql . '</p>';
	echo '<p>' . $initialDate->fullyear . '</p>';
	echo '<p>' . $initialDate->year . '</p>';
	echo '<p>' . $initialDate->something . '</p>';

} catch (Exception $e) {
	echo '<h1>Ooops!</h1>';
	echo $e;
}
