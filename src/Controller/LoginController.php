<?php

namespace App\Controller;


// use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Builder;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LoginController extends AbstractController
{
    use JwtTrait;
 /**
 * @Route("/client_inscription", name="clientInscription", methods="POST")
 */
    public function clientInscription(Request $request)
    {
        $data = json_decode($request->getContent(),true);

        //var_dump($data);
        $account_type = $data["account_type"];
        $nom = $data["nom"];
        $prenoms = $data["prenoms"];
        $email = $data["email"];
        $telephone = intval($data["telephone"]);
        $photo_url = $data["photo_url"];
        $password = $data["password"];

        $em = $this->getDoctrine();
        if ($account_type ==0){
            $var = $em->getConnection()->prepare('CALL __client_register(:nom, :prenoms, :telephone, :email, :photo_url, :password)');
            $var->execute([
                "nom"=>$nom,"prenoms"=>$prenoms,"telephone"=>$telephone,"email"=>$email,"photo_url"=>$photo_url, "password"=>$password
            ]);
        }else {
            $var = $em->getConnection()->prepare('CALL __conducteur_register(:nom, :prenoms, :telephone, :email,  :photo_url, :account_type, :password)');
            $var->execute([
                "nom"=>$nom,"prenoms"=>$prenoms,"telephone"=>$telephone,"email"=>$email,
                "photo_url"=>$photo_url,"account_type"=>$account_type, "password"=>$password
            ]);
        }


        $res = $var->fetchAll();

        return new JsonResponse($res);

    }

    /**
     * @Route("/connexion", name="userConnexion", methods="post")
     */
    public function conducteurConnexion(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $email = $data["email"];
        $password = $data["password"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __user_login2(?,?)');
        $var->execute([$email,$password]);
        $res = $var->fetch();

        if($res['statut'] == 1){
            return new JsonResponse([ $res, $this->token_generate($res['id_user'], ['data' => $res]) ] );
        }
        
        return new JsonResponse([$res]);
    }

    /**
     * @Route("/password_reset", name="password_reset", methods="post")
     */
    public function password_reset(Request $request, \Swift_Mailer $mailer)
    {
        $data = json_decode($request->getContent(),true);
        $email = $data["email"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __user_password_reset(?)');
        $var->execute([$email]);
        $res = $var->fetch();

         if( $res['code_genere'] !== '0'){
            $message = (new \Swift_Message('Code Renitialisation'))
                ->setFrom("contacts@umbono-ddrive.com")
                ->setTo($email)
                ->setBody(
                    "<h1>".$res['code_genere']."</h1>",
                    'text/html'
                );

            $mailer->send($message);

            return new JsonResponse('Votre code de renitialisation a ete envoye');
        }

        return new JsonResponse($res);
    }


   /**
     * @Route("/password_renew", name="password_renew", methods="post")
     */
    public function password_renew(Request $request, \Swift_Mailer $mailer)
    {
        $data = json_decode($request->getContent(),true);
        $email = $data["email"];
	    $code = $data["code"];
	    $password = $data["password"];

        $em = $this->getDoctrine();
        $var = $em->getConnection()->prepare('CALL __token_verif(?)');
        $var->execute([$code]);
        $res = $var->fetch();

         if( $res['email'] == $email) {
                $em = $this->getDoctrine();
        	$var = $em->getConnection()->prepare('CALL __user_password_change(?, ?, ?)');
        	$var->execute([$email, $code, $password]);
        	$res = $var->fetch();

            return new JsonResponse(['__error_msg'=>'Mot de passe change']);
        }

        return new JsonResponse("Impossible de changer le mot de passe");
    }

}
