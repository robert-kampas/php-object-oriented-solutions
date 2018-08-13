<?php

require_once('../../Ch2/Downloads/DownloadsInterface.php');
require_once('../../Ch2/Downloads/Product.php');
require_once('../../Ch2/Downloads/Ebook.php');

$ebook = new Ebook('PHP Object Oriented-Solutions', 300);
$ebook->display();

var_dump(get_class($ebook));
var_dump(get_parent_class($ebook));
var_dump(is_subclass_of($ebook, 'Product'));
var_dump($ebook instanceof Product);
var_dump($ebook instanceof DownloadsInterface);
