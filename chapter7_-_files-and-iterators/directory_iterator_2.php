<?php

$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/var/www/oop.local/'));

foreach ($dir as $file) {
	echo $file . '<br>';
}