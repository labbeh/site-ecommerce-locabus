<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class ValidPanierController extends AbstractController
{
    /**
     * @Route("/validPanier", name="validPanier")
     */
    public function index(Security $security)
    {
        if(is_null($security->getUser())){
            return $this->redirectToRoute('accueil');
        }

        $user = $security->getUser();

        // contenu du panier avant validation
        return $this->render('produits/validPanier.html.twig', [
            'controller_name' => 'PanierController',
            'listePdts' => $user->getReservations()
        ]);
    }
}