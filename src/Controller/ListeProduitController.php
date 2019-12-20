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
       /* $car1 = array(
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
            'energie' => 'GNV');*/

        // la clef sera la clef primaire du véhicule dans la table
        $listePdts = array(
            /*'car1' => $car1,
            'car2' => $car2,
            'car3' => $car3,
            'car4' => $car4*/
        );

        $cars = $this->getDoctrine()->getRepository('App:Vehicule')->findAllUnbook(date("Y-m-d"));
        //$cpt = 1;
        $marques = array();
        $energys = array();
        $normes = array();

        foreach ($cars as $car) {
           if (!in_array($car->getModele()->getMarque(), $marques)) {
               array_push($marques, $car->getModele()->getMarque());
           }
           if (!in_array($car->getEnergie(), $energys)) {
               array_push($energys, $car->getEnergie());
           }
           if (!in_array($car->getNorme(), $normes)) {
               array_push($normes, $car->getNorme());
           }
        }

        return $this->render('produits/liste.html.twig', ['controller_name' => 'ListeProduitController',
                                                                'listePdts' => $cars, 'marques' => $marques, 'energys' => $energys, 'normes' => $normes
        ]);
    }
}