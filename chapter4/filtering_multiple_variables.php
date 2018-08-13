<?php

$data = [
	'age' => 11,
	'rating' => 4,
	'price' => 9.95,
	'thousands' => '100,000.95',
	'european' => '100.000,95',
];

$instructions = [
	'age' => filter_id('int'),
	'rating' => [
		'filter' => FILTER_VALIDATE_INT,
		'options' => [
			'min_range' => 1,
			'max_range' => 5,
		],
	],
	'price' => [
		'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
		'flags' => FILTER_FLAG_ALLOW_FRACTION,
	],
	'thousands' => [
		'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
		'flags' => FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND
	],
	'european' => [
		'filter' => FILTER_VALIDATE_FLOAT,
		'options' => [
			'decimal' => ','
		],
		'flags' => FILTER_FLAG_ALLOW_THOUSAND,
	],
];

$filtered = filter_var_array($data, $instructions);

print_r($filtered);