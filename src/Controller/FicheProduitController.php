<?php


namespace App\Controller;

use App\Entity\Reservation;
use DatePeriod;
use DateInterval;
use DateTime;
use App\Form\RegistrationFormType;
use App\Form\ReservationFormType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use phpDocumentor\Reflection\Types\Resource_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FicheProduitController extends AbstractController
{
    /**
     * @Route("/fiche", name="fiche")
     */
    public function index(Request $request, Security $security)
    {
        $res = new Reservation();

        $vehicule = $this -> getDoctrine() -> getRepository('App:Vehicule') -> findOneByid($_GET["car"]);

        $dateres = array();

        $existRes = $vehicule->getReservations();

        foreach ($existRes as $anRes) {
            $daterange = new DatePeriod($anRes->getDateDebut(), new DateInterval('P1D'), $anRes->getDateFin());
            foreach($daterange as $date){
                array_push($dateres, $date->format("y-m-d"));
            }
        }

        if ($request->isMethod('post') && !is_null($security->getUser())) {
            $dateDebut = DateTime::createFromFormat('m/d/Y', $request->request->get('dateDebut'));
            $dateFin = DateTime::createFromFormat('m/d/Y', $request->request->get('dateFin'));
            $newDateRange = new DatePeriod($dateDebut, new DateInterval('P1D'), $dateFin);
            foreach($newDateRange as $date){
                if (in_array($date->format("y-m-d"), $dateres)) {
                    $errorMessage = "Vous ne pouvez pas réserver autour de jours déjà réservés";
                    return $this->render('produits/fiche.html.twig', ['controller_name' => 'FicheProduitController',
                        "GET" => $_GET, "vehicule" => $vehicule, "error" => $errorMessage, "dateRes" => $dateres
                    ]);
                }
            }
            // encode the plain password
            $res->setUser($security->getUser());
            $res->setVehicule($vehicule);
            $res->setState("cart");
            $res->setPrice(date_diff($dateDebut, $dateFin->add(new DateInterval('P1D')))->days * $vehicule->getPrice());
            $res->setDateDebut($dateDebut);
            $res->setDateFin($dateFin);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($res);
            $entityManager->flush();

            return $this->redirectToRoute("produits");
        }



        // devra être récupérer via le liens
        return $this->render('produits/fiche.html.twig', ['controller_name' => 'FicheProduitController',
            "GET" => $_GET, "vehicule" => $vehicule, "error" => "", "dateRes" => $dateres
        ]);
    }
}