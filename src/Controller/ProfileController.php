<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/upload", name="upload")
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request) :JsonResponse
    {
        $post = json_decode($request->getContent(),true);

        $id_user = (int) $post['id'];
        $extension = $post['extension'];
        $doc_type = $post['doc_type'];
        $url_photo = 'uploads/users/'.$id_user.'_'.$doc_type.'.'.$extension;
        $img = $post['photo']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';

        if ($extension == "jpg" || $extension =="jpeg"){
            $img = str_replace('data:image/jpeg;base64,', '', $img);
        }elseif ($extension == "png"){
            $img = str_replace('data:image/png;base64,', '', $img);
        }

        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents($url_photo, $data);


        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __user_add_new_doc(?, ?, ?)');
        $var->execute([
            $doc_type, $url_photo, $id_user
        ]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }


    /**
     * @Route("/password_change", name="password_change")
     * @param Request $request
     * @return JsonResponse
     */
    public function password_change(Request $request) :JsonResponse
    {
        $post = json_decode($request->getContent(),true);
        $mail = $post["mail"];
        $password = $post["password"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __password_change(?, ?)');
        $var->execute([ $mail, $password ]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/get_conducteur", name="get_conducteur")
     */
    public function get_drivers()
    {

        $user_id=$_GET["user_id"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('SELECT id_conducteur FROM conducteur WHERE id_user = ? ');
        $var->execute([$user_id]);
        $res = $var->fetch();

        return new JsonResponse($res);
    }

    /**
     * @Route("/get_client", name="get_client")
     */
    public function get_client()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('SELECT id_client FROM clients WHERE id_user = ? ');
        $var->execute([$user_id]);
        $res = $var->fetch();
        return new JsonResponse($res);
    }


    //-------------------REQUETE POUR LES CLIENTS-----------------------------------------------//


    /**
     * @Route("/my_taxi_reserved", name="my_taxi_reserved")
     */
    public function my_taxi_reserved()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_historique_attente_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }


    /**
     * @Route("/my_taxi_finished", name="my_taxi_finished")
     */
    public function my_taxi_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_historique_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxi_cancel", name="my_taxi_cancel")
     */
    public function my_taxi_cancel()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_client_decmde(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


    /**
     * @Route("/my_taxishared_reserved", name="my_taxishared_reserved")
     */
    public function my_taxishared_reserved()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_historique_attente_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxishared_finished", name="my_taxishared_finished")
     */
    public function my_taxishared_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_historique_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_taxishared_cancel", name="my_taxishared_cancel")
     */
    public function my_taxishared_cancel()
    {
        $id_cmd=$_GET["id_cmd"];
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __taxi_partager_client_decmde(?, ?);');
        $var->execute([$id_cmd, $user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_carpooling_reserved", name="my_carpooling_reserved")
     */
    public function my_carpooling_reserved()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_historique_attente_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

    /**
     * @Route("/my_carpooling_finished", name="my_carpooling_finished")
     */
    public function my_carpooling_finished()
    {
        $user_id=$_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_historique_client(?)');
        $var->execute([$user_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }


    /**
     * @Route("/my_carpooling_cancel", name="my_carpooling_cancel")
     */
    public function my_carpooling_cancel()
    {
        $id_proposition=$_GET["id_proposition"];
        $user_id=$_GET["user_id"];
        $id_cmd=$_GET["id_cmd"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_decmde_client (?, ?, ?);');
        $var->execute([$id_proposition, $user_id, $id_cmd]);
        $res = $var->fetch();

        // $res['uuid_by_proposition'] = json_decode($res[0]['uuid_by_proposition'], true);
        // foreach ($res[0]['uuid_by_proposition'] as $value) {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$res['uuid_by_proposition'].'/'."Un client vient d'annuler son trajet" ); 
        // }

        return new JsonResponse($res);
    }

    /**
     * @Route("/client_waiting_alert", name="client_waiting_alert")
     */
    public function driver_waiting_alert(Request $request)
    {
        //$post = json_decode($request->getContent(),true);
        $client_id = $_GET["user_id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __notif_client_cmde_taxi(?)');
        $var->execute([$client_id]);
        $res = $var->fetchAll();
        return new JsonResponse($res);
    }

}
