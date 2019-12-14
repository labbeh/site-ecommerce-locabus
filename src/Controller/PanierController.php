<?php

namespace App\Controller;

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

        $listePdts = $entityManager->getRepository(Vehicule::class)->findAll();

        // ce tableau représente le contenu du panier

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $listePdts
        ]);
    }
}