<?php

require_once '../Ch2/AbstractProduct.php';
require_once '../Ch2/Book.php';
require_once '../Ch2/DVD.php';

$book = new Ch2_Book('PHP Object Oriented-Solutions', 300);
$movie = new Ch2_DVD('Lord of The Rings', 160);

//echo '<p>The ' . $book->getProductType() . ' "' . $book->getProductTitle() . '" has ' . $book->getPageCount() . ' pages</p>';
//echo '<p>DVD is a ' . $product->getProductType() . ' called ' . $product->getProductTitle() . '</p>';

$book->display();
$movie->display();