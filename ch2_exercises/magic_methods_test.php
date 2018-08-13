<?php

/*class TestClass
{
    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function __toString()
    {
        return $this->foo;
    }
}

$class = new TestClass('Hello');

echo $class;*/

/*class TestDebugInfo {
	public $publicVariable;
	protected $protectedVariable;
	private $privateVariable;

    public function __construct($publicVariable, $protectedVariable, $privateVariable) {
        $this->publicVariable = $publicVariable;
        $this->protectedVariable = $protectedVariable;
        $this->privateVariable = $privateVariable;
    }

    public function __debugInfo() {
    	return array(
        	$this->publicVariable,
        	$this->protectedVariable . '[PROTECTED]'
    	);
    }
}

var_dump(new TestDebugInfo('public', 'protected', 'private'));*/

class CallableClass
{
    public function __invoke($x)
    {
        return $x * 5;
    }
}

$object = new CallableClass;

var_dump($object(5));