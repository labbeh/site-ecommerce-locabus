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
        $cars = $this->getDoctrine()->getRepository('App:Vehicule')->findAllUnbook(date("Y-m-d"));
        $marques = array();
        $energys = array();
        $normes = array();
        $critairs = array();

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
           if (!in_array($car->getCritair(), $critairs)) {
               array_push($critairs, $car->getCritair());
           }
        }

        return $this->render('produits/liste.html.twig', ['controller_name' => 'ListeProduitController',
                                                                'listePdts' => $cars, 'marques' => $marques, 'energys' => $energys, 'normes' => $normes, 'critairs' => $critairs
        ]);
    }
}