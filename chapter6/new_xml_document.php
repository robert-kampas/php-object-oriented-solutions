<?php

// Create new root element
$newXML = new SimpleXMLElement('<root></root>');
// Add an element node
$book1 = $newXML->addChild('book');
// Add child nodes with text nodes
$book1->addChild('title', 'Build Your Own XML');
$book1->addChild('title', 'All my own work!');

// Add second element node with child nodes
$book2 = $newXML->addChild('book');
$book2->addChild('title', 'Awesome XML');
$book2->addChild('title', 'XML Guru');

// Send an XML header and output the XML to aa user
header('Content-Type: text/xml');
echo $newXML->asXML();