<?php

/*class ExceptionTest extends Exception
{
	private $input;

	public function __construct($input)
	{
		if (is_array($input) === true) {
			throw new Exception();
		}
	}
}

try {
	new ExceptionTest(array());
} catch(BadFunctionCallException $e) {
	echo "BadFunctionCallException";
} catch(Exception $e) {
	echo "Exception";
}*/


/*function foo($func) {
    if (!is_callable($func)) {
        throw new BadFunctionCallException('Function ' . $func . ' is not callable');
    }
}

try {
	foo('iterator_count_x');
} catch(BadFunctionCallException $e) {
	echo $e;
} catch(Exception $e) {
	echo $e;
}*/

class Warehouse
{
	public function getCity()
	{
		return 'London';
	}
}

/*class Product
{
	public function __construct()
	{
		$this->warehouse = new Warehouse();
	}

	public function __call($method, $arguments)
	{
		if (method_exists($this->warehouse, $method)) {
			return call_user_func_array(array($this->warehouse, $method), $arguments);
		}
		else {
			throw new BadMethodCallException("The method '$method' does not exist"); 
		}
	}	
}


try {
	$product = new Product();
	$product->getCityx();
} catch(BadMethodCallException $e) {
	echo $e->getMessage();
} catch(Exception $e) {
	echo 'Exception';
}*/

class Book
{
	public function __construct()
	{
		throw new BadMethodCallException('Custom message', 700);
	}
}

try {
	$book = new Book();
	$book->display();
} catch(BadMethodCallException $e) {
	echo '<p><strong>Message:</strong>' . $e->getMessage() . '</p>';
	echo '<p><strong>Code:</strong>' . $e->getCode() . '</p>';
	echo '<p><strong>File:</strong>' . $e->getFile() . '</p>';
	echo '<p><strong>Line:</strong>' . $e->getLine() . '</p>';
	echo '<p><strong>Trace:</strong>'; print_r($e->getTrace()); echo '</p>';
	echo '<p><strong>Trace as string:</strong>' . $e->getTraceAsString() . '</p>';
	echo '<p><strong>Echo:</strong>' . $e . '</p>';
}
catch(Exception $e) {
	echo 'This catch block will not be reached.';
}