<?php

class Lazy
{
	public $itemName;
	protected $vendorName;

	public function __construct()
	{
		$this->itemName = 'Wireless Mouse';
		$this->vendorName = 'Logitech';
	}

	public function __get($property)  
	{  
		if (property_exists($this, $property)) {  
			return $this->$property; 
		}
		else {
			throw new Exception("Trying to access property that does not exist.");
		}
	}  

	public function __set($property, $value)  
	{  
		if (property_exists($this, $property)) {  
			$this->$property = $value;  
		}  
	}	
}

$lazy = new Lazy();
var_dump($lazy->vendorName);