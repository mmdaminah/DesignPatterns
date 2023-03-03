<?php

interface Command
{
    public function execute();
}

class Command1 implements Command
{
    public function execute()
    {
        echo "executing command1<br>";
    }
}

class Command2 implements Command
{
    public function execute()
    {
        echo "executing command2<br>";
    }
}

class StartCommand implements Command
{

    public function execute()
    {
        echo "starting command<br>";
    }
}

class FinishCommand implements Command
{

    public function execute()
    {
        echo "finishing command<br>";
    }
}

class Invoker
{
    private $commandList = [];
    private Command $onStart;
    private Command $onFinish;

    public function setOnStart(Command $command)
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command)
    {
        $this->onFinish = $command;
    }

    public function addCommand(Command $command)
    {
        $this->commandList[] = $command;
    }

    public function doTheJob()
    {
        foreach ($this->commandList as $command) {
            $this->onStart->execute();
            $command->execute();
            $this->onFinish->execute();
        }
    }
}

$invoker = new Invoker();
$invoker->setOnStart(new StartCommand());
$invoker->setOnFinish(new FinishCommand());
$invoker->addCommand(new Command1());
$invoker->addCommand(new Command2());
$invoker->doTheJob();
