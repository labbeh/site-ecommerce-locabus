<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SupprimerController extends AbstractController
{
    /**
     * @Route("/supprimer", name="supprimer")
     */
    public function index()
    {
        if(sizeof($_POST) == 0){
            return $this->render('erreurdroits.html.twig', [
                'controller_name' => 'SupprimerController',
            ]);
        }

        $table = $_POST["table"];
        $id    = $_POST["id"];

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($table)->findOneByid($id);

        $em->remove($entity);
        $em->flush();

        $response = $this->forward('App\Controller\PageAdminController::index', []);


        return $response;
    }
}