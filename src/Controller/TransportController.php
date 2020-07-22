<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransportController extends AbstractController
{
    /**
     * @Route("/transport", name="transport")
     */
    public function index()
    {
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
        ]);
    }

    /**
     * @Route("/transport_command", name="transport_command", methods="POST")
     */
    public function transportCommand(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $location = $data['location'];
        $latitude = $data['latitude'];
        $longitude = $data['longitude'];
        $location2 = $data['location2'];
        $latitude2 = $data['latitude2'];
        $longitude2 = $data['longitude2'];
        $km = $data['km'];
        $minutes = $data['minutes'];
        $price = $data['price'];
        $id_driver = $data['id_driver'];
        $id_user = $data['id_user'];


        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL taxi_command(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $var->execute([
            $location, $latitude, $longitude, $location2, $latitude2, $longitude2,
            $km, $minutes, $price, $id_driver, $id_user
        ]);
        $res = $var->fetchAll();

        $this->sendMail();

        return new JsonResponse($res);
    }
}
