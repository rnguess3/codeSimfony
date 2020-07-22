<?php

namespace App\Controller;

use Symfony\Component\Mercure\Update;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NotificationController extends AbstractController
{
    /**
     * @Route("/api/ping", name="ping_stats")
     */
    // public function ping(Publisher $publisher)
    public function ping(MessageBusInterface $bus)
    {
        $update = new Update('http://93.104.214.6:3000/umbono/ping', "{msg: OK}");
        // $publisher($update); 
        $bus->dispatch($update);
        return new JsonResponse(['ok test']);
    }

     /**
     * @Route("/user/ping/{uuid}/{msg}", name="ping_user_msg")
     */
    //public function ping2(Publisher $publisher)
    public function ping2(MessageBusInterface $bus, $uuid, string $msg)
    {
        // $target = [];
        // if($user !== null){
        //     $target = ["http://93.104.214.6:3000/umbono/user/{$user->getId()}"];
        // }
        $update = new Update('http://93.104.214.6:3000/umbono/user/'.$uuid, "{msg: $msg}");
        //$publisher($update); 
        $bus->dispatch($update);
        return new JsonResponse(['ok']);
    }


    /**
     * @Route("/taxi/ping/{uuid}", name="ping_uuid") 
     */
    //public function ping_uuid(Publisher $publisher)
    public function ping_uuid(MessageBusInterface $bus, Request $request, $uuid)
    {
        $data = json_decode($request->getContent(),true);
        // $message = $data["message"];

        // $update = new Update("http://93.104.214.6/ping/$uuid", '{"message" : '.$message.'}');
        // $update = new Update("http://93.104.214.6/ping/$uuid", '{"message" : "Bonjour Man"}');
        $update = new Update("http://93.104.214.6:3000/umbono/taxi/$uuid", "'Votre taxi a une nouvelle commande'");
        $bus->dispatch($update);
        return new JsonResponse(['ok test']);
    }

}
 