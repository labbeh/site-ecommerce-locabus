<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class mainController extends AbstractController
{

    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }

}