<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FicheProduitController extends AbstractController
{
    /**
     * @Route("/fiche", name="fiche")
     */
    public function index()
    {
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

        // la clef sera la clef primaire du véhicule dans la table
        $listePdts = array(
            'car1' => $car1,
            'car2' => $car2,
            'car3' => $car3,
            'car4' => $car4
        );
        // devra être récupérer via le liens
        return $this->render('produits/fiche.html.twig', ['controller_name' => 'FicheProduitController',
            "GET" => $_GET, "vehicule" => $listePdts[$_GET["car"]]
        ]);
    }
}