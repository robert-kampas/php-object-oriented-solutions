<?php

require_once 'Pos_RssFeed.php';
require_once 'Pos_MysqlImprovedConnection.php';
require_once 'Pos_MysqlImprovedResult.php';

try {
	$xml = new Pos_RssFeed('localhost', 'root', 'rootpass', 'oop');
	$xml->setFeedTitle('OOP News');
	$xml->setFeedLink('http://oop.local/oop_news.xml');
	$xml->setFeedDescription('Get the latest news on PHP OOP.');
	$xml->setLastBuildDate(false);
	//$xml->setFilePath('output/oop_news.xml');
	$xml->setItemTitle('title');
	$xml->setItemDescription('article');
	$xml->setItemPubDate('updated');
	$xml->setTable('blog', 10);
	//$xml->setItemLinkURL('http://oop.local/');
    $xml->setItemLink('article_id');
	$result = $xml->generateXML();

	if ($result) {
		header('Content-Type: text/xml');
		echo $result;
	    //echo 'XML file created';
	}
	else {
		echo 'Error';
	}
} catch(Exception $e) {
	echo $e->getMessage();
}