<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
<<<<<<< HEAD
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
=======
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
>>>>>>> 2d2348a3201b44234af38d1d3b1e062c5329b35c
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
<<<<<<< HEAD
	
	#[Route('/category/new', name: 'app_category_new')]
	// Response : valeur de retour / typé les données
	public function create(
		EntityManagerInterface $em,
		Request $request
	): Response
	{
		$category = new Category();
		$form = $this->createForm(CategoryType::class, $category);
		$form->handleRequest($request);
		
		// "isSubmitted()" : soumis
		// "isValid()" : valide en fonction des critères
		if ($form->isSubmitted() && $form->isValid()) {
			// prépare l'inserte
			$em->persist($category);
			// implémente dans la BDD
			$em->flush();
		}
		
		// "[]" : tableau
		return $this->render('category/form.html.twig', [
			'form' => $form->createView(),
		]);
	}
=======

    #[Route('/category/new', name: 'app_category_new')]
    public function create(
        EntityManagerInterface $em,
        Request $request
    ): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
        }

        return $this->render('category/form.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
>>>>>>> 2d2348a3201b44234af38d1d3b1e062c5329b35c
}
