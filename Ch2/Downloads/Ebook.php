<?php

class Ebook extends Product implements DownloadsInterface 
{
	protected $_pageCount;

	public function __construct($title, $pageCount)
	{
		$this->_title = $title;
		$this->_pageCount = $pageCount;
		$this->_type = 'book';
	}

	final function getPageCount()
	{
		return $this->_pageCount;
	}
		
	public function getFileLocation()
	{

	}

	public function createDownloadLink()
	{

	}

	public function display()
	{
		echo "<p>Book: $this->_title ($this->_pageCount pages)</p>";
	}
}