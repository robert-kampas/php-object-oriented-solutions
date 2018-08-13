<?php

$session = curl_init('code.ironleg.net');
// Suppress HTTP headers
curl_setopt($session, CURLOPT_HEADER, false);
// Return the remote file as string , rather than output it directly
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
// Get the remote file and store it in the $remoteFile property
$remoteFile = curl_exec($session);
// Get the HTTP status
$status = curl_getinfo($session, CURLINFO_HTTP_CODE);
// Close the cURL connection
curl_close($session);

var_dump($status);