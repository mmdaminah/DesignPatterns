<?php

interface Gateway
{
    public function addInfo($info);

    public function payment();
}

class Zarinpal implements Gateway
{
    protected $info;

    public function payment()
    {
        return $this->info;
    }

    public function addInfo($info)
    {
        $this->info = $info;
    }
}

class Mellat implements Gateway
{
    protected $info;

    public function addInfo($info)
    {
        $this->info = $info;
    }

    public function payment()
    {
        return $this->info;
    }
}

class Payment
{
    protected $gateway;

    public function gateway(Gateway $gateway)
    {
        $this->gateway =  $gateway;
    }

    public function addInfo($info)
    {
       $this->gateway->addInfo($info);
    }

    public function pay()
    {
        return $this->gateway->payment();
    }
}

$payment = new Payment();
$payment->gateway(new Zarinpal());
$payment->addInfo(["name" => "hesam", "price" => 1000]);
var_dump($payment->pay());
