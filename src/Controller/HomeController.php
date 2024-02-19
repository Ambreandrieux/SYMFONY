<?php

namespace App\Controller;

use App\Form\BrandType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/brand_form', name: 'app_brand_form')]
    public function brandForm(): Response
    {
        $form = $this->createForm(BrandType::class);

        return $this->render('home/brand_form.html.twig', [
            'leFormDuController' => $form->createView(),
        ]);
    }
}
