<?php

class Pos_RemoteConnector
{
	protected $_url;
	protected $_remoteFile;
	protected $_error;
	protected $_urlParts;
	protected $_status;

	public function __construct($url)
	{
		$this->_url = $url;
		$this->checkURL();

		if (ini_get('allow_url_fopen')) {
			$this->accessDirect();
		} elseif (function_exists('curl_init')) {
			$this->useCurl();
		} else {
			$this->useSocket();
		}
	}

	protected function checkURL()
	{
		return;

		/*$flags = FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED;
		$urlOK = filter_var($this->_url, FILTER_VALIDATE_URL, $flags);
		$this->_urlParts = parse_url($this->_url);
		$domainOK = preg_match('/^[^.]+?\.\w{2}/', $this->_urlParts['host']);

		if (!$urlOK || $this->_urlParts['scheme'] != 'https' || !$domainOK) {
			throw new Exception($this->_url . ' is not a valid URL');
		}*/
	}

	protected function accessDirect()
	{
		$this->_remoteFile = @file_get_contents($this->_url);
		$headers = @ get_headers($this->_url);

		if ($headers) {
			preg_match('/\d{3}/', $headers[0], $m);
			$this->_status = $m[0];
		}
	}

	protected function useCurl()
	{
		if ($session = curl_init($this->_url)) {
			// Suppress HTTP headers
			curl_setopt($session, CURLOPT_HEADER, false);
			// Return the remote file as string , rather than output it directly
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
			// Get the remote file and store it in the $remoteFile property
			$this->_remoteFile = curl_exec($session);
			// Get the HTTP status
			$this->_status = curl_getinfo($session, CURLINFO_HTTP_CODE);
			// Close the cURL connection
			curl_close($session);
		} else {
			$this->_error = 'Cannot eastablish cURL session.';
		}
	}

	protected function useSocket()
	{
		$port = isset($this->_urlParts['port']) ? $this->_urlParts['port'] : 80;
		$remote = @ fsockopen($this->_urlParts['host'], $port, $errno, $errstr, 30);

		if (!$remote) {
			$this->_remoteFile = false;
			$this->_error = "Couldn't create a socket connection: $errstr";
		}

		// Add the query string to the path, if it exists
		if (false === isset($this->_urlParts['path'])) {
			$path = '/';
		} else {
			if (isset($this->_urlParts['query'])) {
				$path = $this->_urlParts['path'] . '?' . $this->_urlParts['query'];
			} else {
				$path = $this->_urlParts['path'];
			}
		}

		// Create the request headers
		$out = "GET $path HTTP/1.1\r\n";
		$out .= "Host: {$this->_urlParts['host']}\r\n";
		$out .= "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:60.0) Gecko/20100101 Firefox/60.0";
		$out .= "Connection: Close\r\n\r\n";
		
		if ($remote) {
			// Send the headers
			fwrite($remote, $out);

			// Capture the response
			$this->_remoteFile = stream_get_contents($remote);
			fclose($remote);

			if ($this->_remoteFile) {
				$this->removeHeaders();
			}
		}
	}	

	protected function removeHeaders()
	{
		$parts = preg_split('#\r\n\r\n|\n\n#', $this->_remoteFile);

		if (is_array($parts)) {
			$headers = array_shift($parts);
			$file = implode("\n\n", $parts);

			if (preg_match('#HTTP/1\.\d\s+(\d{3})#', $headers, $m)) {
				$this->_status = $m[1];
			}

			if (preg_match('#Content-Type:([^\r\n]+)#i', $headers, $m)) {
				// Handle accordint to content type
				if (stripos($m[1], 'xml') !== false || stripos($m[1], 'html') !== false) {
					if (preg_match('/<.+>/s', $file, $m)) {
						$this->_remoteFile = $m[0];
					} else {
						$this->_remoteFile = trim($file);
					}
				}
			} else {
				$this->_remoteFile = trim($file);
			}
		}
	}

	protected function setErrorMessage()
	{
		if ($this->_status == 200 && $this->_remoteFile) {
			$this->_error = '';
		} else {
			switch ($this->_status) {
				case 200:
				case 204:
					$this->_error = 'Connection OK, is file is empty.';
					break;
				case 404:
					$this->_error = 'File not found.';
					break;
				default:
					$this->_error = 'Undefined error. Check URL and domain name.';
					break;
			}
		}
	}

	public function getErrorMessage()
	{
		if (is_null($this->_error)) {
			$this->setErrorMessage();
		}

		return $this->_error;
	}	

	public function __toString()
	{
		if (!$this->_remoteFile) {
			$this->_remoteFile = '';
		}

		return $this->_remoteFile;
	}
}