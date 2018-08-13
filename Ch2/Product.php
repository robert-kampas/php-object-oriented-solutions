<?php

class Ch2_Product
{
	protected $_type;
	protected $_title;

	public function __construct($type, $title)
	{
		$this->_type = $type;
		$this->_title = $title;
	}

	public function getProductType()
	{
		return $this->_type;
	}

	/*public function setProductType($type)
	{
		$this->_type = $type;
	}*/

	public function getProductTitle()
	{
		return $this->_title;
	}
}
