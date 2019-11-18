<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListeProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
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
            'marque' => 'Irirbus',
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

        // la clef sera la clef primaire du véhicule dans la table
        $listePdts = array(
            'car1' => $car1,
            'car2' => $car2,
            'car3' => $car3,
            'car4' => $car4
        );

        return $this->render('produits/liste.html.twig', ['controller_name' => 'ListeProduitController',
                                                                'listePdts' => $listePdts
        ]);
    }

    // cette fonction fera l'accès base de donnée
    private function getVehicules(){

    }
}