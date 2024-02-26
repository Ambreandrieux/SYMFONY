<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(
        EntityManagerInterface $em
	): Response {
		$brands = $em->getRepository(Brand::class)->findAll();
		
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
			'brands' => $brands,
        ]);
    }

    #[Route('/brand/new', name: 'app_brand_form')]
    #[Route('/brand/edit/{brand}', name: 'app_brand_form_edit')]
    public function brandForm(
        EntityManagerInterface $em,
        Request $request,
		?Brand $brand = null
    ): Response {
		if (!$brand) {
			$brand = new Brand();
		}
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($brand);
            $em->flush();
        }

        return $this->render('home/brand_form.html.twig', [
            'leFormDuController' => $form->createView(),
        ]);
    }
}
