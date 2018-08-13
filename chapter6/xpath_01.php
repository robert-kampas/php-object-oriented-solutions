<?php

$xml = simplexml_load_file('foed.xml');
//$xml->registerXPathNamespace('xx', 'http://www.google.com');
$names = $xml->xpath('//name');

echo '<ul>';
foreach ($names as $name) {
	echo '<li>' . $name . '</li>';
}
echo '</ul>';

echo '<hr>';

$tracks = $xml->xpath('/products/product/@track');
echo '<ul>';
foreach ($tracks as $track) {
	echo '<li>' . $track . '</li>';
}
echo '</ul>';

echo '</pre><hr>';

$brands = $xml->xpath('//brand[. = "Adidas"]');

foreach ($brands as $brand) {
	$name = $brand->xpath('../name');
	$sku = $brand->xpath('../sku');
	$track = $brand->xpath('../@track');

	echo '<p>' . $name[0]. '|' . $sku[0]. '|' . $track[0]. '</p>';
	echo '<hr>';
}

echo '<hr>';

/*
$xml->registerXPathNamespace('dc', 'http://www.w3.org/TR/html4/');
$msrp = $xml->xpath('//dc:msrp');

echo '<ul>';
foreach ($msrp as $item) {
	echo '<li>' . $item . '</li>';
}
echo '</ul>';
*/