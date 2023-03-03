<?php

interface AbstractFactory
{
    public function createProductA();

    public function createProductB();
}

class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA()
    {
        return new ConcreteProductA1();
    }
    public function createProductB()
    {
        return new ConcreteProductB1();
    }
}

class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA()
    {
        return new ConcreteProductA2();
    }

    public function createProductB()
    {
        return new ConcreteProductB2();
    }
}
interface AbstractProductA {
    public function usefulFunctionA();
}
class ConcreteProductA1 implements AbstractProductA {
    public function usefulFunctionA()
    {
        return "the result of the product A1<br>";
    }
}
class ConcreteProductA2 implements AbstractProductA {
    public function usefulFunctionA()
    {
        return "the result of the product A2<br>";
    }
}
interface AbstractProductB {
    public function usefulFunctionB();

    public function anotherUsefulFunctionB(AbstractProductA $collaborator);
}

class ConcreteProductB1 implements  AbstractProductB{
    public function usefulFunctionB()
    {
        return "the result of the product b1<br>";
    }
    public function anotherUsefulFunctionB(AbstractProductA $collaborator)
    {
        $result = $collaborator->usefulFunctionA();
        return "the result of the b1 collaborating with me $result <br>";
    }
}
class ConcreteProductB2 implements  AbstractProductB{
    public function usefulFunctionB()
    {
        return "the result of the product b2 <br>";
    }
    public function anotherUsefulFunctionB(AbstractProductA $collaborator)
    {
        $result = $collaborator->usefulFunctionA();
        return "the result of the b2 collaborating with me $result <br>";
    }
}


function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB() . "<br>";
    echo $productB->anotherUsefulFunctionB($productA) . "<br>";
}

/**
 * The client code can work with any concrete factory class.
 */
echo "Client: Testing client code with the first factory type:<br>";
clientCode(new ConcreteFactory1());

echo "\n";

echo "Client: Testing the same client code with the second factory type:<br>";
clientCode(new ConcreteFactory2());