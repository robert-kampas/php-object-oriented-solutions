<?php

class PriceFilter extends FilterIterator
{
	protected $_max;

	public function __construct($iterator, $maxPrice)
	{
		parent::__construct($iterator);
		$this->_max = (float) $maxPrice;
	}

	public function accept()
	{
		if (true === isset($this->current()->paperback)) {
			return substr($this->current()->paperback, 0) <= $this->_max;
		}

		return substr($this->current(), 0) <= $this->_max;
	}
}

$xml = simplexml_load_file('books.xml', 'SimpleXMLIterator');
foreach ($xml->book as $book) {
	foreach (new PriceFilter($book->price, 30) as $price) {
		echo "$book->title ($price)<br>";
	}
}