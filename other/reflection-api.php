<?php

$class = new Exception();
echo get_class($class) . "\n\n";
print_r(get_class_methods($class));

/*namespace Facebook\Entities;

class UUID {}  
abstract class Entity {}  
interface Friendable {}  
interface Likeable {}  
interface Postable {}

class User extends Entity implements Friendable, Likeable, Postable {  
public function __construct($name, UUID $uuid){}  
public function like(Likebable $entity){}  
public function friend(User $user){}  
public function post(Post $post){}  
}

$reflection = new \ReflectionClass(new User('Philip Brown', new UUID(1234))); */

//echo $reflection->getName();  
//echo $reflection->getShortName();  
//echo $reflection->getNamespaceName();  
/*$parent = $reflection->getParentClass();  
echo $parent->getName(); */

/*$interfaces = $reflection->getInterfaceNames();
echo "<pre>";  
var_dump($interfaces); */

/*$interfaces = $reflection->getInterfaces();
echo "<pre>";  
var_dump($interfaces);*/

/*$methods = $reflection->getMethods();  
var_dump($methods);*/

/*$constructor = $reflection->getConstructor();
echo "<pre>";  
var_dump($constructor);  

echo "<pre>";  
var_dump($constructor->getParameters());  

$parameters = $constructor->getParameters();

echo "<pre>";  
var_dump($parameters[1]->getClass());  */