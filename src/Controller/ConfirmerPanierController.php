<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmerPanierController extends AbstractController
{
    /**
     * @Route("/confirmer", name="confirmer")
     */
    public function index(Security $security)
    {
        if(is_null($security->getUser())){
            return $this->redirectToRoute('accueil');
        }

        $user = $security->getUser();

        foreach ($user->getReservations() as $r){
            $this->getDoctrine()->getRepository('App:Reservation')->findOneByid($r->getId())->setState('Valid');
        }

        $this->getDoctrine()->getManager()->flush();

        // contenu du panier avant validation
        return $this->render('produits/confirmer.html.twig', [
            'controller_name' => 'PanierController',
            'user' => $user
        ]);
    }
}