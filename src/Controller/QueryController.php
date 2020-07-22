<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QueryController extends AbstractController
{
    /**
     * @Route("/query_where", name="query_where")
     */
    public function queryWhere() :JsonResponse
    {
        $table=$_GET["table"];
        $colname=$_GET["colname"];
        $colval=$_GET["colval"];
        $order = '';
        if(isset($_GET['order'])){$order = $_GET["order"]; };
        //$order ? null : $_GET["order"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare("SELECT * FROM $table  WHERE $colname = ? $order");
        $var->execute([$colval]);
        $res = $var->fetchAll();

        return new JsonResponse($res);
    }
    
    /**
     * @Route("/admin/covoiturage", name="admin_covoiturage")
     */
    public function covoiturage() :JsonResponse
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare("CALL __get_cmde_covoiturage()");
        $var->execute();
        $res = $var->fetchAll();
        
        return new JsonResponse($res);
    }
    
    /**
     * @Route("/admin/taxi", name="admin_taxi")
     */
    public function taxi() :JsonResponse
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare("CALL __get_cmde_taxi();");
        $var->execute();
        $res = $var->fetchAll();
        
        return new JsonResponse($res);
    }
    
    /**
     * @Route("/admin/taxishared", name="admin_taxishared")
     */
    public function taxisharedtaxishared() :JsonResponse
    {
        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare("CALL __get_cmde_taxi_partage();");
        $var->execute();
        $res = $var->fetchAll();
        
        return new JsonResponse($res);
    }

    /**
     * @Route(path="/call_procedure", name="call_procedure", methods={"POST", "GET"})
     * @return JsonResponse
     */
    public function callProcedure(Request $request): JsonResponse{

        $params = json_decode($request->getContent(), true);
        $params2 = $request->getContent();
        var_dump($params2);

        //Gerer les casts int, string
        // foreach params2 { htmlspecialchars(data)


        $str = "";

        for ($i=0; $i< count($params); $i++){
            $str .= "?,";
        }
        $str = substr($str, 0, -1);

//        $em = $this->getDoctrine();
//        $var = $em->getConnection()->prepare("CALL taxi_command($str)");
//        $var->execute($params2);
//        $res = $var->fetchAll();

        return new JsonResponse([$params]);
    }

}
