<?php

declare(strict_types=1);

require_once('../Ch2/Downloads/DownloadsInterface.php');
require_once('../Ch2/Downloads/Product.php');
require_once('../Ch2/Downloads/Ebook.php');
require_once('ShoppingCart.php');

$ebook = new Ebook('PHP Object Oriented-Solutions', 300);
$ebook->display();

echo '<hr>';

function my_callback_function() {
    echo 'hello world!';
}

$cart = new ShoppingCart();
$cart->addItem($ebook);
$cart->selfHint($cart);
$cart->arrayHint(array());
$cart->boolHint(false);
$cart->callableHint("my_callback_function"); // double qoutation marks matter!
$cart->floatHint(1.2344);
$cart->intHint(1);
$cart->stringHint('ok');