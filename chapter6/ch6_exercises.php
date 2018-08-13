<?php

require_once '../chapter5/Pos/RemoteConnector.php';

try {
	$foed = new Pos_RemoteConnector('http://web.archive.org/web/20120116173151/http://friendsofed.com:80/news.php');

	if ($foed) {
		$xml = simplexml_load_string($foed);

		if (//$xml->asXML('foed.xml')) {
			echo 'XML saved';
		} else {
			echo 'Could not save XML';
		}
	}
	else {
		echo $foed->getErrorMessage();
	}
} catch (Exception $e) {
	echo $e->getMessage();
}