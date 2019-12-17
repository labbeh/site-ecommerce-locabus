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
        $enTete = array(); // nom des colonnes
        $type = ""; // sert à envoyer à la vue le nom de l'entité en question pour la suppression
        $i = 0; // pour ajouter les éléments dans le tableau envoyé à twig

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
            $enTete[sizeof($enTete)] = "modèle";

            $vehicules = $this->getDoctrine()->getRepository('App:Vehicule')->findAll();
            $type = "App:Vehicule";

            // id 	modele_id 	ptac 	nb_places 	energie 	annee 	norme 	critair 	description
            foreach ($vehicules as $v){
                $vehicule = array(
                    "id" => $v->getId(),
                    "ptac" => $v->getPtac(),
                    "nb_places" => $v->getNbPlaces(),
                    "energie" => $v->getEnergie(),
                    "annee" => $v->getAnnee(),
                    "norme" => $v-> getNorme(),
                    "critair" => $v -> getCritair(),
                    "description" => $v-> getDescription(),
                    "modele" => $v->getModele()
                );
                $datas[$i] = $vehicule;
                $i++;
            }


           /* $qb = $this
                ->createQueryBuilder('a')
                ->innerJoin('a.activiteEnseignements', 'acti')
                ->addSelect('acti')
                ->where('acti.degre = 1')
                ->andWhere('acti.forme = :frm')
                ->setParameter('frm', $idForme)
                ->andWhere('a.groupe = :gr')
                ->setParameter('gr', $idGroupe);*/
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