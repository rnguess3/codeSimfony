<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
      /**
     * @Route("/api/stats", name="course_stats")
     */
    public function stats()
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __stat()');
        $var->execute();
        $res = $var->fetch();

        return new JsonResponse($res, 200);
    }	

    /**
     * @Route("/api/course_disponible", name="course_disponible")
     */
    public function courseAvailable()
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_disponible()');
        $var->execute();
        $res = $var->fetchAll();

        return new JsonResponse($res, 201);
    }	

    /**
     * @Route("/course_lists", name="course_lists")
     */
    public function courseLists()
    {
        // CALL __select_many_trajets_coovoiturage("abidjan", "daloa", "2019-01-29");
        //$data = json_decode($request->getContent(),true);
        $lieu_depart=$_GET["lieu_depart"];
        $lieu_arrivee=$_GET["lieu_arrivee"];
        $date_trajet=$_GET["date_trajet"];

	//return new JsonResponse($date_trajet);

        if($date_trajet == 'null'){
            $date_trajet = date("Y-m-d");
        }else{
            $myDateTime = \DateTime::createFromFormat('Y-m-d', $date_trajet);
            $date_trajet = $myDateTime->format('Y-m-d');
        }

       

        $em = $this->getDoctrine();
        //$var = $em->getConnection()->prepare('CALL __coovoiturage_select_many_trajets(?, ?, ?)');
	$var = $em->getConnection()->prepare('CALL __coovoiturage_disponible_plusieurs(?, ?)');
        //$var->execute([$lieu_depart, $lieu_arrivee,$date_trajet]);
	$var->execute([$lieu_depart, $lieu_arrivee]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/course_one/{id}", name="course_one", methods="GET")
     * @param $id
     * @return JsonResponse
     */
    public function courseOne($id)
    {
        // $id=$_GET["id"];
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('SELECT * FROM __test_list_trajet  WHERE id =?');
        $var->execute([$id]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }

    /**
     * @Route("/course_add", name="course_add", methods="POST")
     */
    public function courseAdd(Request $request)
    {
        $data = json_decode($request->getContent(),true);

        $location = $data["location"];
        $location_latitude = $data["location_latitude"];
        $location_longitude = $data["location_longitude"];
        $location_end = $data["location_end"];
        $location_latitude2 = $data["location_latitude"];
        $location_longitude2 = (float) $data["location_longitude"];
        $course_type = intval($data["course_type"]);
        $driver_id = (int) $data["driver_id"];
        $price = (int) $data["price"];
        $place_number= (int) $data["place_number"];
        $course_datetime = date('Y-m-d h:i:s', strtotime($data["course_datetime"]));

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __coovoiturage_proposition_trajet(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $var->execute([
            $location,
            $location_latitude,
            $location_longitude,
            $location_end,
            $location_latitude2,
            $location_longitude2,
            $course_type,
            $driver_id,
            $price,
            $place_number,
            $course_datetime
        ]);

        $res = $var->fetchAll();

        return new JsonResponse($res);

    }

    /**
     * @Route("/course_reservation", name="course_reservation", methods="POST")
     */
    public function courseCommand(Request $request)
    {
        $data = json_decode($request->getContent(),true);

        $id_proposition = (int) $data["id_proposition"];
        $id_user = (int) $data["id_user"];
        $reserved_places = (int) $data["reserved_places"];
        $price = (int) $data["price"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL 	__coovoiturage_cmde(?,?,?,?)');
        $var->execute([$id_proposition, $id_user, $reserved_places, $price]);

        $res = $var->fetchAll();

        $msg = "Un nouveau client vient de s'ajouter sur votre trajet";
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://93.104.214.6/umbono/user/ping/'.$res[0]['uuid_conducteur'].'/'.$msg ); 
        $res[0]['notification'] = $res[0]['uuid_conducteur'];

        return new JsonResponse($res);
    }

}
