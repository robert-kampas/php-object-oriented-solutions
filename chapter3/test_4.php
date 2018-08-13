<?php

require_once 'Pos/Date.php';

try {
	$customDate = new Pos_Date();
	$customDate->setDate(2008, 8, 31);
	$customDate->addMonths(22);

	$defaultDate = new DateTime();
	$defaultDate->setDate(2008, 8, 31);
	$defaultDate->modify('+22 month');

	echo '<p>Add 1 month using addMonths(): ' . $customDate->getMySQLFormat() . '</p>';
	echo '<p>Add 1 month using modify(): ' . $defaultDate->format('Y-m-d') . '</p>';

	echo '<hr>';

	$customDate = new Pos_Date();
	$customDate->setDate(2008, 8, 31);
	$customDate->subMonths(18);

	$defaultDate = new DateTime();
	$defaultDate->setDate(2008, 8, 31);
	$defaultDate->modify('-18 month');

	echo '<p>Substract 18 month using subMonths(): ' . $customDate->getMySQLFormat() . '</p>';
	echo '<p>Substract 18 month using modify(): ' . $defaultDate->format('Y-m-d') . '</p>';

	echo '<hr>';

	$customDate = new Pos_Date();
	$customDate->setDate(2008, 8, 31);
	$customDate->addYears(10);	

	echo '<p>Add 10 years using addYears(): ' . $customDate->getMySQLFormat() . '</p>';

	$customDate = new Pos_Date();
	$customDate->setDate(2008, 8, 31);
	$customDate->subYears(10);	

	echo '<p>Substract 10 years using subYears(): ' . $customDate->getMySQLFormat() . '</p>';

	$defaultDate = new DateTime();
	$defaultDate->setDate(2008, 8, 31);
	$defaultDate->modify('+10 year');	

	echo '<p>Add 10 years using modify(): ' . $defaultDate->format('Y-m-d') . '</p>';
} catch (Exception $e) {
	echo $e;
}