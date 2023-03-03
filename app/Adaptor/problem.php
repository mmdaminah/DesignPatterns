<?php

class Facebook
{
    public function getUserToken($userdate)
    {
        // return token
    }

    public function postUpdate($token, $message)
    {

    }
}

$facebook = new Facebook();
$token = $facebook->getUserToken([
    'email' => 'mmdamin@gmail.com',
    'password' => "1234"
]);
$facebook->postUpdate($token, "random Message");

class Twitter {
    public function checkUserToken($userdate)
    {
        // return token
    }

    public function setStatusUpdate($token, $message)
    {

    }
}

$twitter = new Twitter();
$token = $twitter->checkUserToken([
    'email' => 'mmdamin@gmail.com',
    'password' => "1234"
]);
$twitter->setStatusUpdate($token, "random Message");
