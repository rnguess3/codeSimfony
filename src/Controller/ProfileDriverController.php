<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileDriverController extends AbstractController
{

    /**
     * @Route("/my_taxi_course", name="my_taxi_course")
     */
    public function my_taxi_course()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_historique_attente_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxi_course_finished", name="my_taxi_course_finished")
     */
    public function my_taxi_course_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_historique_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


    /**
     * @Route("/my_taxi_validation", name="my_taxi_validation")
     */
    public function my_taxi_valid()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
//        $var = $em->getConnection()->prepare('CALL __taxi_validation_cmde_conducteur(?, ?);');
        $var = $em->getConnection()->prepare('CALL __valider_cmde_taxi_conducteur(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$res[0]['uuid_client'].'/'.'votre commande a ete validee' ); 
        $res[0]['notification'] = $res[0]['uuid_client'];

        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxi_conducteur_cancel", name="my_taxi_conducteur_cancel1")
     */
    public function my_taxi_conducteur_cancel()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_conducteur_decmde(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetch();

        $client = HttpClient::create();
        $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$res['uuid_by_client'].'/'."votre commande a ete annulée" ); 
        $res['notification'] = $res['uuid_by_client'];

        return new JsonResponse($res);
    }


    /**
     * @Route("/my_taxishared_course", name="my_taxishared_course")
     */
    public function my_taxishared_course()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_historique_attente_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxishared_course_finished", name="my_taxishared_course_finished")
     */
    public function my_taxishared_course_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_historique_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxishared_validation", name="my_taxishared_validation")
     */
    public function my_taxishared_valid()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_validation_cmde_conducteur(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


    /**
     * @Route("/my_taxishared_conducteur_cancel", name="my_taxishared_conducteur_cancel")
     */
    public function my_taxishared_conducteur_cancel()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_conducteur_decmde(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


    /**
     * @Route("/my_carpooling_course", name="my_carpooling_course")
     */
    public function my_carpooling_course()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_historique_attente_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_carpooling_course_finished", name="my_carpooling_course_finished")
     */
    public function my_carpooling_course_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_historique_conducteur(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_carpooling_validation", name="my_carpooling_validation")
     */
    public function my_carpooling_validation()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_validation_conducteur(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_carpooling_conducteur_cancel", name="my_carpooling_conducteur_cancel")
     */
    public function my_carpooling_cancel()
    {
        $id_proposition=$_GET["id_proposition"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_decmde_conducteur (?, ?);');
        $var->execute([$id_proposition, $user_id]);
        $res = $var->fetch();
        if($res['uuid_by_proposition'] !== null){
            $res['uuid_by_proposition'] = json_decode($res['uuid_by_proposition'], true);
            foreach ($res['uuid_by_proposition'] as $value) {
                $client = HttpClient::create();
                $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$value.'/'.'le trajet de covoiturage a été annulé par le chauffeur' ); 
            }
        }
        return new JsonResponse($res);
    }


    /**
     * @Route("/profile_position_update", name="profile_position_update")
     */
    public function profile_position_update(Request $request)
    {
        $post = json_decode($request->getContent(),true);
        $driver_id = $post["driver_id"];
        $longitude = $post["longitude"];
        $latitude = $post["latitude"];
        $status = $post["status"] ?? 1;
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL 	__taxi_update_position(?, ?, ?, ?)');
        $var->execute([$driver_id, $longitude, $latitude, $status]);
        $res = $var->fetch();
        return new JsonResponse($res);
    }

    /**
     * @Route("/driver_waiting_alert", name="driver_waiting_alert")
     */
    public function driver_waiting_alert(Request $request)
    {
        //$post = json_decode($request->getContent(),true);
        $driver_id = $_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __notif_cmde_taxi_conducteur(?)');
        $var->execute([$driver_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


}
