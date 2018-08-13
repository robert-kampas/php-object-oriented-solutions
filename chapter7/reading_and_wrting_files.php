<?php

$dir = new DirectoryIterator('test_files');
foreach ($dir as $file) {
	//Make sure it's not a dot file or directory
	if (!$file->isDot() && !$file->isDir()) {
		// Open file
		$currentFile = $file->openFile();
		// Loop through each line of the file and display it
		foreach ($currentFile as $line) {
			echo $line . '<br>';
		}
		echo '<hr>';
	}
}

echo '<hr>';

$file = new SplFileObject('test_files/file3.txt');
foreach ($file as $line) {
	echo $line . '<br>';
}