<?php

namespace App\Controller;

use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(Security $security)
    {
        if(is_null($security->getUser())){
            return $this->redirectToRoute('accueil');
        }

        //$entityManager = $this->getDoctrine()->getManager();
        $user = $security->getUser();

        $reservations = array();
        $i =0;
        foreach ($user->getReservations() as $r){
            if($r->getState() == 'cart')
                $reservations[$i++] = $r;
        }

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $reservations
        ]);
    }
}