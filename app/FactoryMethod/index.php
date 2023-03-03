<?php

abstract class Creator
{
    abstract public function factoryMethod();

    public function someOperation()
    {
        $product = $this->factoryMethod();
        $result = "Creator: The same creator's code has just worked with <br> ";
        $product->operation();
        return $result;
    }
}

class ConcreteCreator1 extends Creator
{
    public function factoryMethod()
    {
        return new ConcreteProduct1();
    }
}

class ConcreteCreator2 extends Creator
{
    public function factoryMethod()
    {
        return new ConcreteProduct2();
    }
}

interface Product
{
    public function operation();
}

class ConcreteProduct1 implements Product
{
    public function operation()
    {
        return "{result of concrete product1}<br>";
    }
}

class ConcreteProduct2 implements Product
{
    public function operation()
    {
        return "{result of concrete product2}<br>";
    }
}

function clientCode(Creator $creator)
{
    echo "Client: I'm not aware of the creator's class, but it still works.<br>"
        . $creator->someOperation();
}

echo "App: Launched with the ConcreteCreator1.<br>";
clientCode(new ConcreteCreator1());
echo "\n\n";

echo "App: Launched with the ConcreteCreator2.<br>";
clientCode(new ConcreteCreator2());