<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Vehicule;
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

        $entityManager = $this->getDoctrine()->getManager();
        $listePdts = array();
        $user = $security->getUser();
        // ce tableau représente le contenu du panier

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $user->getReservations()
        ]);
    }
}