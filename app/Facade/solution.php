<?php

class Validate
{
    public function isValid($data)
    {
        return true;
    }
}

class User
{
    public function create($data)
    {
        return true;
    }
}

class Mail
{
    public function to($email, $password)
    {
        return $this;
    }

    public function subject($subject)
    {
        return $this;
    }

    public function send()
    {
        return true;
    }
}

class Auth
{
    public function login($email, $password)
    {
        return true;
    }
}

class SignUpFacade
{
    private $validate;
    private $user;
    private $auth;
    private $mail;

    public function __construct()
    {
        $this->validate = new Validate();
        $this->user = new User();
        $this->auth = new Auth();
        $this->mail = new Mail();
    }

    public function signUpUser($name, $email, $password)
    {
        if ($this->validate->isValid($user)) {
            $this->user->create($name, $email, $password);
            $this->auth->login($email, $password);
            $this->mail->to($email, $password);
        }
    }
}


$signUpFacade = new SignUpFacade();
$signUpFacade->signUpUser("mmdamin", "mmdamin@gmail.com", "1234");