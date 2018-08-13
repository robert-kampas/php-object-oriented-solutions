<?php

class classC
{
	protected static $_counter = 0;
	public $num;

	public function __construct()
	{
		self::$_counter++;
		$this->num = self::$_counter;
	}
}

$object1 = new classC();
echo '<p>' . $object1->num . '</p>';
$object2 = new classC();
echo '<p>' . $object2->num . '</p>';