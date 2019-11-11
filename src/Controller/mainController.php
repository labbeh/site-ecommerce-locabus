<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class mainController
{

    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('client/index.html.twig');
    }

}