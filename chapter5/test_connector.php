<?php

require_once 'Pos/RemoteConnector.php';
$url = 'http://php.net/manual/en/function.strpos.phpss';

try {
	$output = new Pos_RemoteConnector($url);

	if (strlen($output) && empty($output->getErrorMessage())) {
		echo $output;
	} else {
		echo $output->getErrorMessage();
	}
} catch(Exception $e) {
	echo $e->getMessage();
}