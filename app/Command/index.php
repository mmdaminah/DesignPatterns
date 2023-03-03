<?php

interface Car
{

}

class PrideCar implements Car
{

}

abstract class CarWashCommand
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    abstract public function execute();
}

class CarSimpleWashCommand extends CarWashCommand
{
    public function execute()
    {
        echo "washed with water";
    }
}

class CarDryCommand extends CarWashCommand
{
    public function execute()
    {
        echo 'Car dried';
    }
}

class CarWaxCommand extends CarWashCommand
{
    public function execute()
    {

    }
}

class CarWash
{
    protected $customerList;

    public function newCustomer($taskList)
    {
        $this->customerList[] = $taskList;
    }

    public function wash()
    {
       foreach($this->customerList as $customer){
           foreach ($customer as $command){
               $command->execute();
           }
       }
    }
}

$prideCar = new PrideCar();
$carWash = new CarWash();

$carWash->newCustomer(
    [
        new CarSimpleWashCommand($car),
        new CarDryCommand($car)
    ]
);

$carWash->newCustomer(
    [
        new CarSimpleWashCommand($car),
        new CarDryCommand($car),
        new CarWaxCommand($car)
    ]
);
