<?php

abstract class Ch2_AbstractProduct
{
	protected $_type;
	protected $_title;

	public function getProductType()
	{
		return $this->_type;
	}

	public function getProductTitle()
	{
		return $this->_title;
	}

	abstract public function display();
}