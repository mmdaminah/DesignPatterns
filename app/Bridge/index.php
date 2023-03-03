<?php

abstract class Shape
{
    protected $width;
    protected $height;
    protected $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function changeColor($color)
    {
       $this->color = $color;
    }
    abstract public function draw();
}

class Square extends Shape
{
    public function draw()
    {
        echo "drawing a {$this->color->getColor()} Square<br>";
    }
}

class Circle extends shape
{
    public function draw()
    {
        echo "drawing a {$this->color->getColor()} Circle<br>";
    }
}

abstract class Color
{
    protected $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
       return $this->color;
    }
    abstract public function setColor();
}

class Red extends Color
{

    public function setColor()
    {
    }
}

class Blue extends Color
{
    public function setColor()
    {
    }
}

$red = new Red('red');
$blue = new Blue('blue');

$redCircle = new Circle($red);
$redCircle->draw();

$blueCircle = new Circle($blue);
$blueCircle->draw();
