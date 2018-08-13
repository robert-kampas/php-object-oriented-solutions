<?php

$xml = simplexml_load_file('foed.xml');

foreach ($xml->product as $product) {
	echo '<h2>' . $product->name . '</h2>';
	echo '<p>' . $product->description . '</p>';
	$dc = $product->children('dc', true);
	echo '<p>Price: $' . $dc->price . '</p>';
	$dca = $product->attributes('dc', true);
	echo '<p>ID: ' . $dca['id'] . '</p>';	
}

echo '<hr><pre>';
print_r($xml->getNamespaces(true));
print_r($xml->getDocNamespaces(true));
