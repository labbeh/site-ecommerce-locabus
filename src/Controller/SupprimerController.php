<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SupprimerController extends AbstractController
{
    /**
     * @Route("/supprimer", name="supprimer")
     */
    public function index($table, $id)
    {
        return $this->render('erreurdroits.html.twig', [
            'controller_name' => 'SupprimerController',
        ]);
    }
}