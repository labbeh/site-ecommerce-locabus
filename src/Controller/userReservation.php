<?php


namespace App\Controller;


use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class userReservation extends AbstractController
{
    /**
     * @Route("/userRes", name="userRes")
     */
    public function index(Security $security)
    {

        $datas = array(); // données en sortie vers la template
        $enTete = array(); // nom des colonnes
        $type = ""; // sert à envoyer à la vue le nom de l'entité en question pour la suppression
        $i = 0; // pour ajouter les éléments dans le tableau envoyé à twig

        //$enTete = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\Reservation')->getColumnNames();
        $enTete =array();
        array_push($enTete, "marque");
        array_push($enTete, "modele");
        array_push($enTete, "date debut");
        array_push($enTete, "date fin");
        array_push($enTete, "etat");
        array_push($enTete, "prix");

        $resas = $this->getDoctrine()->getRepository('App:Reservation')->findBy(array("user"=>$security->getUser()->getId()));
        $type = "App:Reservation";

        foreach ($resas as $r){
            $resa = array(
                "marque" => $r->getVehicule()->getModele()->getMarque(),
                "modele" => $r->getVehicule()->getModele(),
                "date_debut" => $r->getDateDebut()->format('Y-m-d'),
                "date_fin" => $r ->getDateFin()->format('Y-m-d'),
                "etat" => $r->getState(),
                "prix" => $r->getPrice()
            );
            $datas[$i] = $resa;
            $i++;
        }

        return $this->render('userRes.html.twig', [
            'controller_name' => 'PageAdmin',
            'entete' => $enTete,
            'datas' => $datas,
            'type' => $type
        ]);
    }
}