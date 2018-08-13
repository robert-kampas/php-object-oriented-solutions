<?php

class Warehouse
{
	public function getCity()
	{
		return 'London';
	}
}

class Product
{
	public function __construct()
	{
		$this->warehouse = new Warehouse();
	}

	public function getQuantity()
	{
		return 100;
	}

	public function getWarehouseCity()
	{
		return $this->warehouse->getCity();
	}

	public function __call($method, $arguments)
	{
		// check that the other object has the specified method
		if (method_exists($this->warehouse, $method)) {
			// invoke the method and return any result
			return call_user_func_array(array($this->warehouse, $method), $arguments);
		}
		else {
			return 'Method does not exist.';
		}
	}	
}

$product = new Product();
echo $product->getQuantity(); // 100
echo $product->getWarehouseCity(); // London
echo $product->getCity(); // London
echo $product->getSomething(); // Method does not exist.