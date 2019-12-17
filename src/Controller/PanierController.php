<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Vehicule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $panier = $entityManager->getRepository(Panier::class)->findBy(array('user_id' => $this->get('security.context')->getToken()->getUser()->getId()));
        $listePdts = $panier->getReservations()->getVehicule();
        // ce tableau représente le contenu du panier

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $listePdts
        ]);
    }
}