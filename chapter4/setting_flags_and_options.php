<?php

// Flags only
$var = '100,000.98';
$filtered = filter_var($var, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);
echo $filtered;

echo '<hr>';

// Options only
$var = '6';
$filtered = filter_var($var, FILTER_VALIDATE_INT, array('options' => array('min_range' => 5, 'max_range' => 10)));
echo var_dump($filtered);

echo '<hr>';

// Flags and options
$var = '100.861,60';
$filtered = filter_var($var, FILTER_VALIDATE_FLOAT, array(
	'options' => array('decimal' => ','), 
	'flags' => FILTER_FLAG_ALLOW_THOUSAND
));
echo var_dump($filtered);

echo '<hr>';

$var = '10.5';
$var = '10,5';
$filtered = filter_var($var, FILTER_VALIDATE_FLOAT, array('options' => array('decimal' => ',')));
echo var_dump($filtered);