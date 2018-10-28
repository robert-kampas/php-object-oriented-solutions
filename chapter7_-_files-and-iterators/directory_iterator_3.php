<?php

$dir = new DirectoryIterator('.');

foreach ($dir as $file) {
	echo $file->getFilename() . '<br>';
}

echo '<hr>';

$file = new SplFileInfo('directory_iterator_3.php');
echo $file->getRealPath() . ' | ' . $file->getPerms();

echo '<hr>';


$octalPermissions = substr(sprintf('%o', $file->getPerms()), -4);
echo $octalPermissions;

echo '<hr>';

$file = new SplFileInfo('directory_iterator_3.php');
echo 'getATime() ' . $file->getATime() . '<br>';
echo 'getCTime() ' . $file->getCTime() . '<br>';
echo 'getMTime() ' . $file->getMTime() . '<br>';
echo 'getFilename() ' . $file->getFilename() . '<br>';
echo 'getGroup() ' . $file->getGroup() . '<br>';
echo 'getInode() ' . $file->getInode() . '<br>';
//echo 'getLinkTarget() ' . $file->getLinkTarget() . '<br>';
echo 'getOwner() ' . $file->getOwner() . '<br>';
echo 'getPath() ' . $file->getPath() . '<br>';
echo 'getPathname() ' . $file->getPathname() . '<br>';
echo 'getRealPath() ' . $file->getRealPath() . '<br>';
echo 'getPerms() ' . $file->getPerms() . '<br>';
echo 'getSize() ' . $file->getSize() . '<br>';
echo 'getType() ' . $file->getType() . '<br>';
echo 'isDir() ' . var_dump($file->isDir()) . '<br>';
echo 'isExecutable() ' . var_dump($file->isExecutable()) . '<br>';
echo 'isWritable() ' . var_dump($file->isWritable()) . '<br>';
echo 'isReadable() ' . var_dump($file->isReadable()) . '<br>';
