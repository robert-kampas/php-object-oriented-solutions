<?php

$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/var/www/oop.local/'));
$xmlFiles = new RegexIterator($dir, '/\.xml$/i');

foreach ($xmlFiles as $file) {
	echo $file . '<br>';
}