<?php

interface Notification
{
    public function send($title, $message);
}

class EmailNotification implements Notification
{
    private $adminEmail;

    public function __construct($adminemail)
    {
        $this->adminemail = $adminemail;
    }

    public function send($title, $message)
    {
        mail($this->adminemail, $title, $message);
        echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.";
    }
}

class SlackApi
{
    private $login;
    private $apiKey;

    public function __construct($login, $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function login()
    {
        echo "Logged in to a slack account '{$this->login}'.\n";
    }

    public function sendMessage($chatId, $message)
    {
        echo "Posted following message into the '$chatId' chat: '$message'.\n";
    }
}

class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    public function __construct($slack, $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    public function send($title, $message)
    {
        $slackMessage = "#" . $title . "#" . strip_tags($message);
        $this->slack->login();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

function clientCode(Notification $notification)
{
    echo $notification->send("Website is down!",
        "<strong style='color:red;font-size: 50px;'>Alert!</strong> " .
        "Our website is not responding. Call admins and bring it up!");
}

echo "Client code is designed correctly and works with email notifications:\n";
$notification = new EmailNotification("developers@example.com");
clientCode($notification);
echo "\n\n";


echo "The same client code can work with other classes via adapter:\n";
$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotification($slackApi, "Example.com Developers");
clientCode($notification);