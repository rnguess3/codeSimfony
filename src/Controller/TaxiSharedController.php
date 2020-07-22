<?php

namespace App\Controller;

use const null;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaxiSharedController extends AbstractController
{


    /**
     * @Route("/taxishared_add", name="taxishared_add", methods="POST")
     */
    public function taxiSharedAdd(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $id_type_course = 2;
        $end = htmlspecialchars($data['end']);
        $street_end = htmlspecialchars($data['street_end']) ;
        $start = htmlspecialchars($data['start']);
        $street_start = $data['street_start'];
        $longitude1 = (float) $data['longitude1'];
        $latitude1 = (float) $data['latitude1'];
        $longitude2 = (float) $data['longitude2'];
        $latitude2 = (float) $data['latitude2'];
        $place_number = (int) $data['place_number'];
        $price = (int) ($data['price']);
        $datehour = date('Y-m-d h:i:s', strtotime($data['datehour']));
        $user_id = (int) $data['user_id'];

        $params = [
            $start,
            $longitude1,
            $latitude1,
            $end,
            $longitude2,
            $latitude2,
            $price,
            $user_id,
            $place_number,
            $id_type_course,
            $street_start,
            $street_end,
            $datehour
        ];

        $em = $this->getDoctrine();
//        CALL __cmde_taxi_ok_ok(1, 4, 5, 2, 5, 6, 4000, NULL, 1, 1, 2, "tville", "adjame", NOW())
        $var = $em->getConnection()->prepare('CALL __taxi_partager_cmde(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $var->execute($params);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/taxishared_disponible", name="taxishared_disponible")
     */
    public function taxisharedAvailable()
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_disponible()');
        $var->execute();
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }	

    /**
     * @Route("/taxishared_list", name="taxishared_list", methods="GET")
     */
    public function taxiSharedList(Request $request)
    {

        $location_start = (string)$_GET["location_start"];
        $location_end = (string)$_GET["location_end"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_disponible_plusieurs(?, ?)');
        $var->execute([$location_start, $location_end]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/taxishared_client_list", name="taxishared_client_list", methods="GET")
     */
    public function taxiSharedClientList(Request $request)
    {
        $command_id = (string)$_GET["command_id"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('
                SELECT a.id_cmde_taxi,a.depart,a.arriver, b.longitude_client, b.latitude_client
                FROM `cmde_taxi_client` as a
                  JOIN itineraire_cmde_taxi AS b
                    ON (a.id_cmde_taxi = b.id_cmde_taxi)
                WHERE a.id_cmde_taxi = ? AND id_type_course = 2'
        );
        $var->execute([$command_id]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }


//    /**
//     * Route("/taxishared_command", name="taxishared_command", methods="POST")
//     */
//    public function taxiSharedCommand(Request $request)
//    {
//        $data = json_decode($request->getContent(), true);
//
//        $location = $data['location'];
//        $latitude = $data['latitude'];
//        $longitude = $data['longitude'];
//        $location2 = $data['location2'];
//        $latitude2 = $data['latitude2'];
//        $longitude2 = $data['longitude2'];
//        $km = $data['km'];
//        $minutes = $data['minutes'];
//        $price = $data['price'];
//        $id_driver = $data['id_driver'];
//        $id_user = $data['id_user'];
//
//        $em = $this->getDoctrine();
//        $var = $em->getConnection()->prepare('CALL taxi_command(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
//        $var->execute([
//            $location, $latitude, $longitude, $location2, $latitude2, $longitude2,
//            $km, $minutes, $price, $id_driver, $id_user
//        ]);
//        $res = $var->fetchAll();
//
//        $this->sendMail();
//
//        return new JsonResponse($res);
//    }

    private function sendMail()
    {
        $to      = 'jeanstefyu@gmail.com';
        $subject = 'le sujet';
        $message = 'Bonjour !';
        $headers = 'From: webmaster@umbono-drive.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n";

        mail($to, $subject, $message, $headers);
        return new JsonResponse(["1"]);
    }

    /**
     * @Route("/taxishared_accept", name="taxishared_accept", methods="POST")
     */
    public function taxiSharedAccept(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $taxi_command_id = (int) $data['taxi_command_id'];
        $driver_id = (int) $data['driver_id'];

        $params = [
            $taxi_command_id,
            $driver_id]
        ;

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL  __taxi_partager_ajout_conducteur(?, ?)');
        $var->execute($params);
        $res = $var->fetchAll();
        if( isset($res[0]['uuid_client']) ) {
            $res['uuid'] = json_decode($res[0]['uuid_client'], true);
            foreach ($res['uuid'] as $value) {
                $client = HttpClient::create();
                $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$value.'/'.'un conducteur vient d\'accepter votre proposition' ); 
            }
        }
        return new JsonResponse($res);
    }

    /**
     * @Route("/taxishared_client_add", name="taxishared_client_add", methods="POST")
     */
    public function taxiSharedClientAdd(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $taxi_command_id = (int) $data['taxi_command_id'];
        $place_number = (int) $data['place_number'] ?? 1;
        $client_id = (int) $data['client_id'];
        $longitude = (float) $data['longitude'];
        $latitude = (float) $data['latitude'];

        $params = [
            $taxi_command_id,
            $place_number,
            $client_id,
            $longitude,
            $latitude,
            $data['arriver'] ?? null,
            $data['depart'] ?? null
        ];

        $em = $this->getDoctrine();
//        CALL __taxi_partage_ajout_client(11, 1, 4, -3.990962916708952, 5.358152332448938)
        $var = $em->getConnection()->prepare('CALL __taxi_partage_ajout_client(?, ?, ?, ?, ?, ?, ?)');
        $var->execute($params);
        $res = $var->fetchAll();

        $res[0]['uuid'] = json_decode($res[0]['uuid_client'], true);
        foreach ($res[0]['uuid'] as $value) {
            $client = HttpClient::create();
            $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$value.'/'.'nouveau client vient de s\'ajouter' ); 
        }

        return new JsonResponse($res);
    }
    
    /**
     * @Route("/taxishared_disponible", name="taxishared_disponible")
     */
    public function taxiSharedDisponible(Request $request)
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_disponible()');
        $var->execute();
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }	



}
