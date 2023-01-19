<?php

namespace App\Core;


class Security{

    private $token;

    public function __construct(){}

    public function createJWT(array $data){
        $header = base64_encode(json_encode(array("alg"=>"HS512","typ"=>"JWT")));
        $payload = base64_encode(json_encode($data));
        $secret = base64_encode(json_encode('secretkey'));
        $signature = hash_hmac('sha512',$header.".".$payload,$secret);

        $this->token = $header.".".$payload.".".$signature;
    }

    public function getExpireClaim(){
        return time() + 1800;
      }

    public function getToken(){
        return $this->token;
    }

    public function decodeJWT($jwt) {
        $parts = explode('.', $jwt);
        $header = json_decode(base64_decode($parts[0]), true);
        $payload = json_decode(base64_decode($parts[1]), true);
        $signature = $parts[2];
    
        return array(
            'header' => $header,
            'payload' => $payload,
            'signature' => $signature
        );
    }
}