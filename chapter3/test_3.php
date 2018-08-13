<?php

require_once 'Pos/Date.php';

try {
	$date = new Pos_Date();
	//$date->setDate(2008, 9, 1);
	$date->setDMY('1-9-2008');

	echo '<p>getMDY(): ' . $date->getMDY() . '</p>';
	echo '<p>getMDY(1): ' . $date->getMDY(true) . '</p>';
	echo '<p>getDMY(): ' . $date->getDMY() . '</p>';
	echo '<p>getDMY(1): ' . $date->getDMY(true) . '</p>';
	echo '<p>getMySQLFormat(): ' . $date->getMySQLFormat() . '</p>';	
	echo '<hr>';
	echo '<p>getFullYear(): ' . $date->getFullYear() . '</p>';
	echo '<p>getYear(): ' . $date->getYear() . '</p>';
	echo '<p>getMonth(): ' . $date->getMonth() . '</p>';
	echo '<p>getMonth(1): ' . $date->getMonth(true) . '</p>';
	echo '<p>getMonthName(): ' . $date->getMonthName() . '</p>';
	echo '<p>getMonthAbbr(): ' . $date->getMonthAbbr() . '</p>';
	echo '<p>getDay(): ' . $date->getDay() . '</p>';
	echo '<p>getDay(1): ' . $date->getDay(true) . '</p>';
	echo '<p>getDayOrdinal(): ' . $date->getDayOrdinal() . '</p>';
	echo '<p>getDayName(): ' . $date->getDayName() . '</p>';
	echo '<p>getDayAbbr(): ' . $date->getDayAbbr() . '</p>';
	echo '<hr>';
	echo '<p>addDays(7): ' . $date->addDays(7) . $date->getMySQLFormat() . '</p>';
	echo '<p>subDays(-7): ' . $date->subDays(-7) . $date->getMySQLFormat() . '</p>';
	echo '<p>addWeeks(1): ' . $date->setDMY('1-1-2012') . $date->addWeeks(1) . $date->getMySQLFormat() . '</p>';
	echo '<p>subWeeks(1): ' . $date->setDMY('1-1-2012') . $date->subWeeks(1) . $date->getMySQLFormat() . '</p>';

} catch (Exception $e) {
	echo $e;
}