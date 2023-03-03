<?php

abstract class SocialNetworkPoster {
    abstract public function getSocialNetwork();

    public function post($content)
    {
       $network = $this->getSocialNetwork();
       $network->login();
       $network->createPost($content);
       $network->logout();
    }
}
class FacebookPoster extends SocialNetworkPoster {
    private $login, $password;
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getSocialNetwork()
    {
       return new FacebookConnector($this->login, $this->password);
    }
}
class LinkedInPoster extends SocialNetworkPoster {
    private $email, $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    public function getSocialNetwork(){
       return new LinkedInConnector($this->email, $this->password);
    }
}

interface SocialNetworkConnector {
    public function login();

    public function logout();

    public function createPost($content);
}

class FacebookConnector implements SocialNetworkConnector {
    private $login, $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function login()
    {
        echo "facebook login <br>";
    }

    public function logout()
    {
        echo "facebook logout <br>";
    }

    public function createPost($content)
    {
        echo "facebook post created <br>";
    }
}

class LinkedInConnector implements SocialNetworkConnector {

    private $email, $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        echo "linkedin login <br>";
    }

    public function logout()
    {
        echo "linkedin logout <br>";
    }

    public function createPost($content)
    {
        echo "linkedin post created <br>";
    }
}