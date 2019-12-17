<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        $vehicule = new Vehicule();

        $form = $this->createFormBuilder($vehicule)
            ->add('ptac')
            ->add('nbPlaces', NumberType::class)
            ->add('energie')
            ->add('annee', NumberType::class)
            ->add('norme')
            ->add('critair', NumberType::class)
            ->add('description')
            ->add('modele')
            ->add('Sauvegarder', SubmitType::class)
            ->getForm();



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicule);
            $entityManager->flush();

            return $this->render('accueil.html.twig', [
                'controller_name' => 'AccueilController',
            ]);
        }

        return $this->render('form/forms.html.twig', [
            'controller_name' => 'VehiculeController',
            'form' => $form -> createView()
        ]);
    }
}