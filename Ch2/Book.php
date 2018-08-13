<?php

//equire_once 'Product.php';

/*class Ch2_Book extends Ch2_Product
{
	protected $_pageCount;

	public function __construct($type, $title, $pageCount)
	{
		parent::__construct($type, $title);
		$this->_pageCount = $pageCount;
	}

	public function getPageCount()
	{
		return $this->_pageCount;
	}
}*/

//class Ch2_Book extends Ch2_Product

require_once 'AbstractProduct.php';

class ExceptionTest extends Exception
{
	public function __construct($message, $code = 0)
	{
		parent::__construct($message, $code);
	}

	public function __toString()
	{
		return 'Error 500!';
	}
}

class Ch2_Book extends Ch2_AbstractProduct
{
	protected $_pageCount;

	public function __construct($title, $pageCount)
	{
		if (!is_numeric($pageCount) OR $pageCount < 1) {
			throw new ExceptionTest('Page count must be a positive number', 601);
		}

		$this->_title = $title;
		$this->_pageCount = (int) $pageCount;
		$this->_type = 'book';
	}

	final function getPageCount()
	{
		return $this->_pageCount;
	}

	public function display()
	{
		echo "<p>Book: $this->_title ($this->_pageCount pages)</p>";
	}
}
