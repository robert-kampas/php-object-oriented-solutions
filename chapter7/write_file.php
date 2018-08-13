<?php

$file = new SplFileObject('new_files/newfile1.txt', 'a');
$written = $file->fwrite("This was written by an SplFileObject\n");
echo $written . ' bytes written to ' . $file->getFilename();

$file = fopen('new_files/newfile2.txt', 'a');
$written = fwrite($file, "This was written using procedural code\n");
fclose($file);
echo $written . ' bytes written to file';