<?php

//require_once '../Ch2/Product.php';

/*$product = new Ch2_Product;
echo $product->_type;
$product->_type = 'DVD';*/

/*$product->setProductType('DVD');
echo $product->getProductType();*/

/*require_once '../Ch2/Product.php';

$product1 = new Ch2_Product('Book', 'PHP Object Oriented-Solutions');
$product2 = new Ch2_Product('DVD', 'Lord of The Rings');

echo '<p>$product1 is a ' . $product1->getProductType() . ' called ' . $product1->getProductTitle() . '</p>';
echo '<p>$product2 is a ' . $product2->getProductType() . ' called ' . $product2->getProductTitle() . '</p>';*/

require_once '../Ch2/Book.php';
require_once '../Ch2/DVD.php';

$book = new Ch2_Book('PHP Object Oriented-Solutions', 300);
$product2 = new Ch2_DVD('DVD', 'Lord of The Rings');

echo '<p>The ' . $book->getProductType() . ' "' . $book->getProductTitle() . '" has ' . $book->getPageCount() . ' pages</p>';
echo '<p>$product2 is a ' . $product2->getProductType() . ' called ' . $product2->getProductTitle() . '</p>';
