<?php


namespace App\Controller;

use App\Entity\Reservation;
use App\Form\RegistrationFormType;
use App\Form\ReservationFormType;
use phpDocumentor\Reflection\Types\Resource_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FicheProduitController extends AbstractController
{
    /**
     * @Route("/fiche", name="fiche")
     */
    public function index()
    {
        $res = new Reservation();
        $form = $this->createForm(ReservationFormType::class, $res);

        $vehicule = $this -> getDoctrine() -> getRepository('App:Vehicule') -> findOneByid($_GET["car"]);

        $dataVehicule = array(
            'marque' => $vehicule->getModele()->getMarque()->getName(),
            'modele' => $vehicule->getModele(),
            'norme' => $vehicule->getNorme(),
            'energie' => $vehicule->getEnergie(),
            'description' => $vehicule->getDescription()
        );

        // devra être récupérer via le liens
        return $this->render('produits/fiche.html.twig', ['controller_name' => 'FicheProduitController',
            "GET" => $_GET, "vehicule" => $dataVehicule, 'reservationForm' => $form->createView()
        ]);
    }
}