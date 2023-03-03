<?php

interface Command
{
    public function execute();
}

class SimpleCommand implements Command
{
    private $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function execute()
    {
        echo "doing simple command {$this->payload}<br>";
    }
}

class ComplexCommand implements Command
{
    private $receiver;
    private $a;
    private $b;

    public function __construct(Receiver $receiver, $a, $b)
    {
        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $b;
    }

    public function execute()
    {
        echo "complex commnad<br>";
        $this->receiver->doSomething($this->a);
        $this->receiver->doSomethingElse($this->b);
    }
}

class Receiver
{
    public function doSomething($a)
    {
        echo "Receiver: working on ( $a )<br>";
    }

    public function doSomethingElse($b)
    {
        echo "Receiver: Also working on ( $b )<br>";
    }
}

class Invoker
{
    private $onStart;
    private $onFinish;

    public function setOnStart(Command $command)
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command)
    {
        $this->onFinish = $command;
    }

    public function doSomethingImportant()
    {
        echo "Invoker: any jobs before I begin?<br>";
        if ($this->onStart instanceof Command) {
            $this->onStart->execute();
        }
        echo "Invoker: doing something important<br>";

        echo "Invoker: any jobs after I finish?<br>";
        if ($this->onFinish instanceof Command) {
            $this->onFinish->execute();
        }

    }
}

$invoker = new Invoker();
$invoker->setOnStart(new SimpleCommand("Say Hi!"));
$receiver = new Receiver();
$invoker->setOnFinish(new ComplexCommand($receiver, "Send email", "Save report"));

$invoker->doSomethingImportant();