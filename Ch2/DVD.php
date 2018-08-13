<?php

/*require_once 'Product.php';

class Ch2_DVD extends Ch2_Product
*/


require_once 'AbstractProduct.php';

class Ch2_DVD extends Ch2_AbstractProduct
{
	protected $_duration;

	public function __construct($title, $duration)
	{
		$this->_title = $title;
		$this->_duration = $duration;
		$this->_type = 'DVD';
	}

	public function getDuration()
	{
		return $this->_duration;
	}

	public function display()
	{
		echo "<p>DVD: $this->_title ($this->_duration minutes)</p>";
	}	
}