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

$validate = new Validate();
$user = new User();
$auth = new Auth();
$mail = new Mail();

$data = ['email' => "amin@gmail.com",
    "name" => "mmdamin",
    "paassword" => "1234"];
if ($validate->isValid($user)) {
    $user->create($data);
    $auth->login($data['email'], $data['paassword']);
    $mail->to($data['email'], $data['password']);
}