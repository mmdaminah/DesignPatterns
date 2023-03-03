<?php

interface Pizza
{
    public function getPrice();

    public function getDescription();
}

class PlainPizza implements Pizza
{

    public function getPrice()
    {
        return 100;
    }

    public function getDescription()
    {
        return "simple pizza";
    }
}

abstract class ToppingDecorator implements Pizza
{
    protected Pizza $pizza;

    public function __construct(Pizza $pizza)
    {
        $this->pizza = $pizza;
    }

    public function getPrice()
    {
        return $this->pizza->getPrice();
    }

    public function getDescription()
    {
        return $this->pizza->getDescription();

    }

}

class Mozzarella extends ToppingDecorator
{
    public function getPrice()
    {
        return $this->pizza->getPrice() + 20;
    }

    public function getDescription()
    {
        return $this->pizza->getDescription() . ", Mozzarella";
    }
}

class Sause extends ToppingDecorator
{
    public function getPrice()
    {
        return $this->pizza->getPrice() + 10;
    }

    public function getDescription()
    {
        return $this->pizza->getDescription() . ", Sause";
    }
}

$pizza = new Sause(new Mozzarella(new PlainPizza()));
echo $pizza->getPrice();
echo $pizza->getDescription();
