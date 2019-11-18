<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class signinController extends AbstractController
{

    /**
     * @Route("/signin", name="signin")
     */
    public function index()
    {
        return $this->render('signin/signin.html.twig');
    }
}