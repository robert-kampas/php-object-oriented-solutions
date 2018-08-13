<?php

$var = 10;

//$filtered = filter_var($var, FILTER_VALIDATE_FLOAT);
$filtered = filter_var($var, filter_id('float'));

var_dump($filtered);