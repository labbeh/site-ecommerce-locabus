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
        $entityManager = $this->getDoctrine()->getManager();
        $listePdts = array();
        $user = $security->getUser();
        foreach ($user->getReservations() as $res) {
            array_push($listePdts ,$res->getVehicule());
        }
        // ce tableau représente le contenu du panier

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $listePdts
        ]);
    }
}