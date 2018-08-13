<?php

$date = new DateTime();
echo '<p>' . $date->format('l, F jS, Y') . '</p>';

$date = new DateTime('next Monday');
echo '<p>' . $date->format('l, F jS, Y') . '</p>';

$date = new DateTime();
echo '<p>' . $date->format(DateTime::RSS) . '</p>';

$date = new DateTime();
$date->modify('+2 months');
echo '<p>' . $date->format('l, F jS, Y') . '</p>';

$date = new DateTime();
$date->setDate(2008, 8, 8);
echo '<p>' . $date->format('l, F jS, Y') . '</p>';

$date = new DateTimeZone('+0200');
//print_r($date->listAbbreviations());
//print_r($date->listIdentifiers());
echo '<p>' . $date->getName() . '</p>';

$vilnius = new DateTimeZone('Europe/Vilnius');
$date = new DateTime('now', $vilnius);
echo '<p>In Vilnius it is ' . $date->format('l, F jS, Y H:i') . '</p>';

// create a DateTime object
$now = new DateTime();
echo '<p>My local time is ' . $now->format('l,g:i A') . '</p>';

$katmandu = new DateTimeZone('Asia/Katmandu');
$fiji = new DateTimeZone('Pacific/Fiji');

$now->setTimezone($katmandu);
echo '<p>In Katmandu time is ' . $now->format('l,g:i A') . '</p>';

$now->setTimezone($fiji);
echo '<p>In Fiji time is ' . $now->format('l,g:i A') . '</p>';

//phpinfo();