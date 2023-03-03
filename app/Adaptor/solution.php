<?php

interface Social {
    public function getUserToken($userData);

    public function postUpdate($token, $message);
}

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

class Twitter
{
    public function checkUserToken($userdate)
    {
        // return token
    }

    public function setStatusUpdate($token, $message)
    {

    }
}

class TwitterAdaptor implements Social {

    private Twitter $twitter;
    public function __construct()
    {
        $this->twitter = new Twitter();
    }

    public function getUserToken($userData)
    {
       $this->twitter->checkUserToken($userData);
    }

    public function postUpdate($token, $message)
    {
        $this->twitter->setStatusUpdate($token, $message);
    }
}

$twitter = new TwitterAdaptor();
$token = $twitter->getUserToken([
    'email' => 'mmdamin@gmail.com',
    'password' => "1234"
]);
$twitter->postUpdate($token, "random Message");
