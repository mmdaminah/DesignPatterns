<?php

interface Car {
    public function getCost();

    public function getDescription();
}

class Pride implements Car {

    public function getCost()
    {
        return 4000;
    }

    public function getDescription()
    {
        return ' pride';
    }

}

abstract class CarFeature implements Car {
   protected $car;
   public function __construct(Car $car)
   {
       $this->car = $car;
   }
   abstract public function getCost();
    abstract public function getDescription();
}

class PrideWithSunroof extends CarFeature {

    public function getCost()
    {
        return $this->car->getCost() + 500;
    }

    public function getDescription()
    {
        return $this->car->getDescription() . ", sunroof";
    }
}

class PrideWithWheel extends CarFeature {
    public function getCost()
    {
       return $this->car->getCost() + 2300;
    }

    public function getDescription()
    {
       return $this->car->getDescription() . ", wheels";
    }
}

$pride = new Pride();
echo $pride->getCost();
echo $pride->getDescription();

echo "<br>";

$prideWithSunroof = new PrideWithSunroof($pride);
echo $prideWithSunroof->getCost();
echo $prideWithSunroof->getDescription();

echo "<br>";

$prideWithSunroofAndWheel = new PrideWithWheel($prideWithSunroof);
echo $prideWithSunroofAndWheel->getCost();
echo $prideWithSunroofAndWheel->getDescription();
