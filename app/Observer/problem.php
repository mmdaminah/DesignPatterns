<?php

interface Observable
{
    public function register(Observer $observer);

    public function unRegister(Observer $observer);

    public function notify();
}

interface Observer
{
    public function update(Observable $observable);
}

class Service implements Observer
{
    protected $name;
    protected $priority;

    public function __construct($name, $priority = 0)
    {
        $this->name = $name;
        $this->priority = $priority;
    }

    public function update(Observable $observable)
    {
        print_r("<br>{$this->name}:{$observable->getEvent()}<br>");
    }
}

class Publisher implements Observable
{
    protected $event;
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

    public function notify()
    {
        foreach($this->observers as $observer ){
            $observer->update($this);
        }
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->notify();
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getObservers()
    {
       return $this->observers;
    }


}

$notify = new Publisher();

$email = new Service('MailObserver', 30);
$clock = new Service("ClockObserver", 60);
$desktop = new Service("DesktopObserver", 50);
$icons = new Service("IconsObserver", 20);

$notify->register($email);
$notify->register($clock);
$notify->register($desktop);
$notify->register($icons);

$notify->setEvent("doSomething");

$notify->unRegister($email);

$notify->setEvent("something else");

