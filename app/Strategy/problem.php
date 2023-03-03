<?php

class Zarinpal
{
    protected $info;

    public function setInfo($info)
    {
        $this->info = $info;
    }

    public function payment()
    {
        return $this->info;
    }
}

class Mellat
{
    protected $info;

    public function addInfo($info)
    {
        $this->info = $info;
    }

    public function pay()
    {
        return $this->info;
    }
}

class Payment
{
    protected $gateway;

    public function gateway($gateway)
    {
        if($gateway === 'zarinpal'){
            $this->gateway = new Zarinpal();
        }
        else if($gateway === 'mellat'){
           $this->gateway = new Mellat();
        }
    }

    public function addInfo($info)
    {
        if($this->gateway instanceof Zarinpal){
            $this->gateway->setInfo($info);
        }
        else if($this->gateway instanceof Mellat){
            $this->gateway->addInfo($info);
        }
    }

    public function pay()
    {
        if($this->gateway instanceof Zarinpal){
            return $this->gateway->payment();
        }
        else if($this->gateway instanceof Mellat){
            return $this->gateway->pay();
        }
    }
}

$payment = new Payment();
$payment->gateway('zarinpal');
$payment->addInfo(["name" => "hesam", "price" => 1000]);
var_dump($payment->pay());