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

        if(sizeof($_GET) == 0) {
            $enTete = array();
            $datas  = array();
        }

        //if(sizeof($_GET) == 0) $datas = array();
        else if ($_GET["table"] == "utilisateurs"){
            $enTete = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\User')->getColumnNames();
            $all = $this->getDoctrine()->getRepository('App:User')->findAll();

            //$user = array();
            $i = 0;

            $values = array();
            /*foreach($enTete as $col){
                $getter = 'get'.ucfirst($col);
                $values[$col] = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\User')->$getter();
            }*/

            foreach ($all as $user){
                $toarray = array(
                  "id" => $user->getId(),
                  "name" => $user->getUsername()
                );
                $datas[$i++] = $toarray;
            }
//  	id 	display_name 	roles 	password 	email 	last_name 	first_name 	phone

        }

        else if ($_GET["table"] == "vehicules"   ) {
            $enTete = $this->getDoctrine()->getManager()->getClassMetadata('App\Entity\Vehicule')->getColumnNames();
            $all = $this->getDoctrine()->getRepository('App:Vehicule')->findAll();
        }

        else if ($_GET["table"] == "chauffeurs"  ){
            $enTete = array("nom", "permis");
            $all  = array();
        }
        //$datas = array();


        return $this->render('admin.html.twig', [
            'controller_name' => 'PageAdmin',
            'entete' => $enTete,
            'datas' => $datas
        ]);
    }
}