<?php

namespace App\Service;

use Lcobucci\JWT\Builder;

class MercureCookieGenerator{

    private $secret;
    public function __construct($secret){
        $this->secret = $secret;
    }


    public function generate(User $user){
        $time = time();
        $token = (new Builder())
        ->set('mercure', ['subscribe'=>["http://93.104.214.6/umbono/user/$user->getId()"] ])
        ->sign(new Sha384(), 'aVerySecretKey')
        ->getToken(); // Retrieves the generated token
        return "mercureAuthorization={$token}; Path=/hub;";
    }

}