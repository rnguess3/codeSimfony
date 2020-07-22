<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaxiController extends AbstractController
{

    /**
     * @Route("/taxi_list", name="taxi_list", methods="GET")
     */
    public function driversList(Request $request)
    {

        $latitude = (float)$_GET["latitude"];
        $longitude = (float)$_GET["longitude"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_select_many2(-4, 5)');
        // $var = $em->getConnection()->prepare('CALL __taxi_select_many2(?, ?)');
        // $var->execute();
        $var->execute([$longitude, $latitude]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }


    /**
     * @Route("/taxi_command", name="taxi_command", methods="POST")
     */
    public function taxiCommand(Request $request)
    {
        $data = json_decode($request->getContent(), true);

//        return new JsonResponse($data);
//        die();
        $user_id = (int) $data['user_id'];
        $location = $data['location'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $location2 = $data['location2'];
        $latitude2 = $data['latitude2'];
        $longitude2 = $data['longitude2'];
        $km = $data['km'];
        $minutes = $data['minutes'];
        $price = $data['price'];
        $id_driver = (int) $data['id_driver'];
        $quartier = $data['quartier'] ?? null;

//        CALL __taxi_cmde("plateau", -4.018527, 5.333474, "treichville", -4.004369, 5.305074, 48, "3", 4, 1, "notre dame", "gare", NOW(), 1)
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_cmde(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $var->execute([
            $location, $latitude, $longitude, $location2, $latitude2, $longitude2,
            $price, $user_id, 4, 1, $quartier, NULL, NULL, $id_driver
        ]);
        $res = $var->fetchAll();

        //$this->sendMail();
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://93.104.214.6/umbono/taxi/ping/'.$res[0]['uuid_conducteur']); 
        $res[0]['notification'] = $res[0]['uuid_conducteur'];

        return new JsonResponse($res);
    }

    private function sendMail()
    {
        $to      = 'jeanstefyu@gmail.com';
        $subject = 'le sujet';
        $message = 'Bonjour !';
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        return new JsonResponse(["1"]);

//        return $this->render(...);
    }

}