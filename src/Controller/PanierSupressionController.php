<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierSupressionController extends AbstractController
{
    /**
     * @Route("/supprpanier", name="supprpanier")
     */
    public function index()
    {
        // suppression de la réservation dans la base
        if(sizeof($_POST) == 0){
            return $this->redirectToRoute('panier');
        }

        $id = $_POST["id"];

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('App:Reservation')->findOneByid($id);

        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('panier');
    }
}