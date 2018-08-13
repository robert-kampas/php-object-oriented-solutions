<?php

var_dump(filter_has_var(INPUT_GET, 'test'));

echo '<hr>';

var_dump(filter_id('callback'));

echo '<hr>';

print_r(filter_list());

echo '<hr> filter_input:';

var_dump(filter_input(INPUT_GET, 'foo', FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_HEX | FILTER_FLAG_ALLOW_OCTAL)); // false if fails

echo '<hr>';

var_dump(filter_input_array(INPUT_GET, ['test' => FILTER_VALIDATE_INT]));

echo '<hr>';

$int_var1 = 0x64;
$int_var2 = 100;
$int_var3 = '100.0';
$int_var4 = 100.0000; // false
echo 'filter_var: ';
var_dump(filter_var($int_var4, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_HEX));

echo '<hr>';

var_dump(filter_var_array(
	['var1' => $int_var1, 'var2' => $int_var2, 'var3' => $int_var3, 'var4' => $int_var4], 
	[
		'var1' => [
			'filter' => FILTER_VALIDATE_INT,
            'flags' => FILTER_FLAG_ALLOW_HEX
        ], 
		'var2' => [
			'filter' => FILTER_VALIDATE_INT,
            'options' => array('min_range' => 1, 'max_range' => 10)
        ], 
        'var3' => FILTER_VALIDATE_INT, 
        'var4' => FILTER_VALIDATE_INT
    ]
));
