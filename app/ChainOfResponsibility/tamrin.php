<?php

namespace ChainOfResponsibility\Tamrin {
    interface Handler
    {
        public function setNext(Handler $handler);

        public function handle($data);
    }

    abstract class AbstractHandler implements Handler
    {
        protected $next;

        public function setNext(Handler $handler)
        {
            $this->next = $handler;
            return $handler;
        }

        public function handle($data)
        {
            if ($this->next) {
                $this->next->handle($data);
            }
            return null;
        }
    }

    class UserAuthenticateMiddleware extends AbstractHandler
    {
        private $authenticated = ["ali" => true, "larry" => true, "mohammad" => true];

        public function handle($data)
        {
            if($this->authenticated[$data]){
                return $this->next->handle($data);
            }
            else {
                throw new \Exception("user not authenticated");
            }
        }
    }

    class UserExistsMiddleware extends AbstractHandler
    {
        private $users = ["ali", "larry", "mohammad"];

        public function handle($data)
        {
            if(in_array($data, $this->users)){
                return $this->next->handle($data);
            }
            else {
                throw new \Exception("user does not exits.");
            }
        }
    }

    class RoleCheckedMiddleware extends AbstractHandler
    {
        private $roles = [
            "ali" => "admin",
            "larry" => "user",
            "mohammad" => "user"
        ];

        public function handle($data)
        {
            if($this->roles[$data] === 'admin'){
                return "user is OK";
            }
            else {
                return "user is not OK";
            }
        }
    }

    $userExistsMiddleware = new UserExistsMiddleware();
    $userAuthenticated = new UserAuthenticateMiddleware();
    $roleCheckedMiddleware = new RoleCheckedMiddleware();
    $userExistsMiddleware->setNext($userAuthenticated)->setNext($roleCheckedMiddleware);

    try {
        echo $userExistsMiddleware->handle("ali");
        echo $userExistsMiddleware->handle("larry");
        echo $userExistsMiddleware->handle("mamad");
    }
    catch(\Exception $exception){
        echo $exception;
    }
}