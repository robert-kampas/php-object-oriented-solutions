<?php

$string = 'The quick brown fox jumps over the lazy dog';

var_dump(strpos($string, 'quick', 10)); // false
var_dump(strpos($string, 'quick', 4)); // 4
var_dump(strpos($string, 'quick', -40)); // 4
var_dump(strpos($string, 'quick', -10)); // false

var_dump(strpos('PHP Object Oriented Solutions', 'PHP')); // 0

if (strpos('PHP Object Oriented Solutions', 'PHP')) {
	// This is not executed even though the word was found
}