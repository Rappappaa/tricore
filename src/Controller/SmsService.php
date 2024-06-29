<?php

namespace App\Controller;

use Exception;

class SmsService 
{
    private $clientPath;
    private $username;
    private $password;
    private $header;
    private $client;

    public function __construct()
    {
        $this->clientPath = $_ENV['SMS_CLIENT'];
        $this->username = $_ENV['SMS_USERNAME'];
        $this->password = $_ENV['SMS_PASSWORD'];
        $this->header = $_ENV['SMS_HEADER'];
        $this->client = new \SoapClient($this->clientPath);
    }

    public function sendSms()
    {
        try{
            $result = $this->client->smsGonder1NV2(
                array(
                    'username'=> $this->username,
                    'password' => $this->password,
                    'header' => $this->header,
                    'msg' => "test",
                    'gsm' => "905538876292",
                    'filter' => '',
                    'startdate'  => '',
                    'stopdate'  => '',
                    'encoding' => ''
                )
            );

            $result = (string)$result->return;

            if($result !== "20" && $result !== "30" && $result !== "40" && $result !== "50" && $result !== "51" && $result !== "70" && $result !== "80" && $result !== "85")
            {
                return true;
            }

            return false;

        }catch (Exception $ex){
            return false;
        }
    }
}