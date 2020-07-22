<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Ahc\Jwt\JWT;


trait JwtTrait
{

    private $key = 'aVerySecretKey';

    public function token_generate($id, $data = null)
    {
        $jwt =( new JWT($this->key, 'HS512', 3600000000, 20) )->encode(['uid' => $id, 'data' => $data]);
        return $jwt;
    }

    public function token_verify(Request $request)
    {
        $token =  str_replace('Bearer ',"", $request->headers->get('authorization'));
        try{
            return [true, (new JWT($this->key, 'HS512', 360000000000))->decode($token)];
        }catch (\Exception $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public function token_getdata(Request $request)
    {
        $token =  str_replace('Bearer ',"", $request->headers->get('authorization'));
        try{
            return (new JWT($this->key, 'HS512', 360000000000))->decode($token);
        }catch (\Exception $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public function token_permission(Request $request)
    {
        //roles
        $token =  str_replace('Bearer ',"", $request->headers->get('authorization'));
        try{
            return (new JWT($this->key, 'HS512', 360000000000))->decode($token);
        }catch (\Exception $exception){
            echo $exception->getMessage();
            return false;
        }
    }

}

