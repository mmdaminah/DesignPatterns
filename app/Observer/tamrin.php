<?php

 interface Observable {
     public function register(Observer $observer);

     public function unregister(Observer $observer);

     public function notify($message);

 }
 interface Observer {
     public function update($message);
 }

 class Service implements Observer {

     protected $name;

     public function __construct($name)
     {
        $this->name = $name;
     }
     public function update($message)
     {
         echo "<br>$this->name says : $message<br>";
     }
 }

 class Publisher implements Observable {

     protected $observers = [];
     public function register(Observer $observer)
     {
         $observerKey = spl_object_hash($observer);
         $this->observers[$observerKey] = $observer;
     }

     public function unRegister(Observer $observer)
     {
         $observerKey = spl_object_hash($observer);
         unset($this->observers[$observerKey]);
     }

     public function notify($message)
     {
         foreach ($this->observers as $observer){
             $observer->update($message);
         }
     }
 }

$mail = new Service("email");
$clock = new Service("clock");
$chat = new Service("chat");

$publisher = new Publisher();
$publisher->register($mail);
$publisher->register($clock);
$publisher->register($chat);

$publisher->notify("hello everybody");

$publisher->unRegister($clock);

$publisher->notify("clock unregistered");

