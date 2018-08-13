<?php

class ShoppingCart
{
	public function addItem(DownloadsInterface $item)
	{
		echo '<p>' . $item->getProductTitle() . ' added</p>';
	}

	public function selfHint(self $object)
	{
		echo '<p>Is self</p>';
	}

	public function arrayHint(array $object)
	{
		echo '<p>Is array</p>';
	}	

	public function boolHint(bool $object)
	{
		echo '<p>Is boolean</p>';
	}	

	public function callableHint(callable $object)
	{
		echo '<p>Is callable</p>';
	}	

	public function floatHint(float $object)
	{
		echo '<p>Is float</p>';
	}	

	public function intHint(int $object)
	{
		echo '<p>Is int</p>';
	}	

	public function stringHint(string $object)
	{
		echo '<p>Is string</p>';
	}		
}