<?php
/*echo 'filter_has_var: ';
var_dump(filter_has_var(INPUT_GET, 'test'));
echo '<hr>';

echo 'array_key_exists: ';
var_dump(array_key_exists('test', $_GET));
echo '<hr>';

echo 'isset: ';
var_dump(isset($_GET['test']));
echo '<hr>';


var_dump(filter_has_var(INPUT_SERVER, 'SERVER_NAME'));
echo '<hr>';
putenv("UNIQID=ok");
//print_r(getenv($_ENV['UNIQID']));
var_dump(filter_has_var(INPUT_ENV, 'LANGUAGE'));

phpinfo();*/

//print_r(filter_list());

//echo '<hr>' . filter_id('int');

/*
$text   = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Hello World";
var_dump($text, $binary, $hello);

print "<hr>";

$trimmed = trim($text);
var_dump($trimmed);
print "<hr>";

$trimmed = trim($text, " \t.");
var_dump($trimmed);
print "<hr>";

$trimmed = trim($hello, "Hdle");
var_dump($trimmed);
print "<hr>";

$trimmed = trim($hello, 'HdWr');
var_dump($trimmed);
print "<hr>";

$trimmed = trim($nonv, 'a3');
var_dump($trimmed);
*/

$required = array("name", "city", "country", "gender");
$array1 = array("name", "city", "country");
$array2 = array("name", "country");

$result = array_diff($required, array_intersect($array1, $array2));

print_r($result);