<?php


namespace App\Controller;

use App\Entity\Reservation;
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
        $form = $this->createForm(ReservationFormType::class, $res);
        $form->handleRequest($request);

        $vehicule = $this -> getDoctrine() -> getRepository('App:Vehicule') -> findOneByid($_GET["car"]);

        if ($form->isSubmitted() && !is_null($security->getUser())) {
            // encode the plain password
            $res->setUser($security->getUser());
            $res->setVehicule($vehicule);
            $res->setState("cart");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($res);
            $entityManager->flush();

            return $this->forward('App\Controller\ListeProduitController::index', []);
        }

        // devra être récupérer via le liens
        return $this->render('produits/fiche.html.twig', ['controller_name' => 'FicheProduitController',
            "GET" => $_GET, "vehicule" => $vehicule, 'reservationForm' => $form->createView()
        ]);
    }
}