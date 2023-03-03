<?php

namespace ChainOfResponsibility {
    interface Handler
    {
        public function setNext(Handler $handler);

        public function handle($data);
    }

    abstract class AbstractHandler implements Handler
    {
        private $nextHandler;

        public function setNext(Handler $handler)
        {
            $this->nextHandler = $handler;
            return $handler;
        }

        public function handle($data)
        {
            if ($this->nextHandler) {
                return $this->nextHandler->handle($data);
            }
            return null;
        }
    }

    class MonkeyHandler extends AbstractHandler
    {
        public function handle($data)
        {
            if ($data === 'Banana') {
                return "Monkey: I'll eat the Banana <br>";
            } else {
                return parent::handle($data);
            }
        }
    }

    class SquirrelHandler extends AbstractHandler
    {
        public function handle($data)
        {
            if ($data === "Nut") {
                return "Squirrel: I'll eat the Nut";
            } else {
                return parent::handle($data);
            }
        }
    }

    class DogHandler extends AbstractHandler
    {
        public function handle($data)
        {
            if ($data === "MeatBall") {
                return "Dog: I'll eat the " . $data . "<br>";
            } else {
                return parent::handle($data);
            }
        }
    }
    function clientCode(Handler $handler)
    {
        foreach (["Nut", "Banana", "Cup of coffee"] as $food) {
            echo "Client: Who wants a " . $food . "?<br>";
            $result = $handler->handle($food);
            if ($result) {
                echo "  " . $result;
            } else {
                echo "  " . $food . " was left untouched.<br>";
            }
        }
    }

    /**
     * The other part of the client code constructs the actual chain.
     */
    $monkey = new MonkeyHandler();
    $squirrel = new SquirrelHandler();
    $dog = new DogHandler();

    $monkey->setNext($squirrel)->setNext($dog);

    /**
     * The client should be able to send a request to any handler, not just the
     * first one in the chain.
     */
    echo "Chain: Monkey > Squirrel > Dog\n\n";
    clientCode($monkey);
    echo "\n";

    echo "Subchain: Squirrel > Dog\n\n";
    clientCode($squirrel);
}
