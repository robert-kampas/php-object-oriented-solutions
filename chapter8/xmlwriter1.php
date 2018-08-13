<?php

$xml = new XMLWriter();
$xml->openMemory();
$xml->startDocument();
$xml->startElement('inventory');
$xml->startElement('book');
$xml->writeAttribute('isbn13', '978-1-43021-011-5');
$xml->writeElement('title', 'PHP Object-Oriented Solutions');
$xml->writeElement('author', 'David Powers');
$xml->endElement();
$xml->endElement();
header('Content-Type: text/xml');
echo $xml->flush();