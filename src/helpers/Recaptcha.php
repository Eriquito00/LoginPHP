<?php

namespace App\Helpers;

class Recaptcha {
    private $ip;
    private $captcha;
    private $secret;

    public function __construct($ip, $captcha) {
        $this->ip = $ip;
        $this->captcha = $captcha;
        $this->secret = $_ENV["RECAPTCHA_PRIVATE_KEY"];
    }

    public function verifyRecaptcha(){
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$this->secret&response=$this->captcha&remoteip=$this->ip");
        $atributes = json_decode($response, TRUE);
        return $atributes["success"];
    }
}
?>