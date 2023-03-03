<?php

interface Car {
    public function getCost();

    public function description();
    public function wheel();

    public function sunRoof();
}

class Pride implements Car {
    protected $cost = 0;

    public function getCost()
    {
        $this->cost += 4000;
    }

    public function description()
    {
        return 'pride';
    }

    public function wheel()
    {
       $this->cost += 2000;
    }

    public function sunRoof()
    {
        return null;
    }
}

$person1 = new Pride();
echo $person1->getCost();