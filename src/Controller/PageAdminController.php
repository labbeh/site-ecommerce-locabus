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
        if(!$this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
            return $this->render('erreurdroits.html.twig', [
                'controller_name' => 'PageAdmin'
            ]);

        $datas = array(); // données en sortie vers la template
        $enTete = array();
        $type = "";

        // si il n'y a pas de paramètre get on affiche aucun tableau
        if(sizeof($_GET) == 0) {
            $enTete = array(); // contient le nom des colonnes
            $datas  = array(); // contient les données des tuples à envoyer au template
        }

        // affichage des utilisateurs
        else if ($_GET["table"] == "utilisateurs"){
            $enTete = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\User')->getColumnNames();
            $users = $this->getDoctrine()->getRepository('App:User')->findAll();
            $type = "App:User";

            $i = 0;
            foreach ($users as $u){
                // les roles étants sous forme de tableau on construit une chaine
                // permettant l'affichage de tous les roles dans la vue
                $roles = "";
                foreach($u -> getRoles() as $r){
                    $roles = $roles . $r . " ";
                }

                $user = array(
                    "id"           => $u->getId(),
                    "display_name" => $u->getDisplayName(),
                    "roles"        => $roles,
                    "password"     => "CRYPTE", // inutile d'afficher le mot de passe crypté
                    "email"        => $u -> getEmail(),
                    "last_name"    => $u -> getLastName(),
                    "first_name"   => $u -> getFirstName(),
                    "phone"        => $u -> getPhone()
                );
                $datas[$i] = $user;
                $i++;
            }
        }

        else if ($_GET["table"] == "vehicules"   ) {
            $enTete = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\Vehicule')->getColumnNames();
            $vehicules = $this->getDoctrine()->getRepository('App:Vehicule')->findAll();
            $type = "App:Vehicule";
        }

        else if ($_GET["table"] == "chauffeurs"  ){
            $enTete = array("nom", "permis");
            $chauffeurs  = array();
        }

        return $this->render('admin.html.twig', [
            'controller_name' => 'PageAdmin',
            'entete' => $enTete,
            'datas' => $datas,
            'type' => $type
        ]);
    }
}