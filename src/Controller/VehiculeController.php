<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    /**
     * @Route("/vehicule", name="vehicule")
     */
    public function new(Request $request)
    {
        $task = new Vehicule();
        // ...

        $form = $this->createForm(VehiculeFormType::class, $task);

        return $this->render('vehicule/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}