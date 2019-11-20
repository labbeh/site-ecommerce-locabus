<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index()
    {
        // devra être remplit par un accès base de données
        // données en dure pour les tests
        $car1 = array(
            'marque' =>'Mercedes',
            'modele' => 'Intouro',
            'norme' => '€5',
            'energie' => 'Diesel');

        $car2 = array(
            'marque' => 'Irisbus',
            'modele' => 'Crossway',
            'norme' => '€4',
            'energie' => 'Diesel');

        $car3 = array(
            'marque' => 'IVECO',
            'modele' => 'Urbanway',
            'norme' => '€6',
            'energie' => 'GNV');

        $car4 = array(
            'marque' => 'Renault',
            'modele' => 'Agora',
            'norme' => '€2',
            'energie' => 'GNV');

        // ce tableau représente le contenu du panier
        $listePdts = array(
            'car1' => $car1,
            'car2' => $car4,
        );

        return $this->render('produits/panier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $listePdts
        ]);
    }
}