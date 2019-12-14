<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageAdminController extends AbstractController
{
    /**
     * @Route("/adminpg", name="adminpg")
     */
    public function index()
    {
        // données en dure temporaire avant connexion à la base
        $enTete = array();
        if(sizeof($_GET) == 0) $enTete = array();
        else if      ($_GET["table"] == "utilisateurs") $enTete = array("Nom", "Username", "Supprimer");
        else if ($_GET["table"] == "vehicules"  ) $enTete = array("Id", "Marque", "Modele", "Energie");
        else if ($_GET["table"] == "chauffeurs" ) $enTete = array("Id", "Nom", "Prenom", "Permis");

        $usr1 = array(
            "Nom" => "Mdaghri",
            "Username" => "hjr",
        );

        $usr2 = array(
            "Nom" => "delanus",
            "Username" => "jean-gary",
        );

        $vh1 = array("Id" => "349",
            "Marque" => "Mercedes",
            "Modele" => "Intouro",
            "Energie" => "Diesel");

        $vh2 = array("Id" => "349",
            "Marque" => "Mercedes",
            "Modele" => "Intouro",
            "Energie" => "Diesel");

        $vh3 = array("Id" => "349",
            "Marque" => "Mercedes",
            "Modele" => "Intouro",
            "Energie" => "Diesel");

        $vh4 = array("Id" => "350",
            "Marque" => "Mercedes",
            "Modele" => "Intouro",
            "Energie" => "Diesel");

        $ch1 = array("Id" => "001",
            "Nom" => "Bus",
            "Prenom" => "Iris",
            "Permis" => "D");

        $datas = array();

        if(sizeof($_GET) == 0) $datas = array();
        else if      ($_GET["table"] == "utilisateurs") $datas = array($usr1, $usr2);
        else if ($_GET["table"] == "vehicules"  ) $datas = array($vh1, $vh2, $vh3, $vh4);
        else if ($_GET["table"] == "chauffeurs" ) $datas = array($ch1);


        return $this->render('admin.html.twig', [
            'controller_name' => 'PageAdmin',
            'entete' => $enTete,
            'datas' => $datas
        ]);
    }
}