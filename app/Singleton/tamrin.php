<?php

class Test {
    private $number;
    public function __construct()
    {
        $this->number = rand();
    }

    public function getNumber()
    {
       return $this->number;
    }
}

$test1 = new Test();
echo "{$test1->getNumber()}<br>";

$test2 = new Test();
echo "{$test2->getNumber()}<br>";


$test3 = new Test();
echo "{$test3->getNumber()}<br>";

class Singleton {
    public static $instance = null;
    private $number;
    private function __construct()
    {
        $this->number = rand();
    }

    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new Singleton();
            return self::$instance;
        }
        return self::$instance;
    }

    public function getNumber()
    {
       return $this->number;
    }
}

$instance1 = Singleton::getInstance();
echo "{$instance1->getNumber()}<br>";

$instance2 = Singleton::getInstance();
echo "{$instance2->getNumber()}<br>";

$instance3 = Singleton::getInstance();
echo "{$instance3->getNumber()}<br>";
