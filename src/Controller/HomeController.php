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
	// une page
	// app_home : home controller
    #[Route('/home', name: 'app_home')]
    // index : methode
    public function index(
	    // injection de dépendance, connexion BDD
        EntityManagerInterface $em
	): Response {
		$brands = $em->getRepository(Brand::class)->findAll();
		
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
			'brands' => $brands,
        ]);
    }
	
	// créer une nvelle form
    #[Route('/brand/new', name: 'app_brand_form')]
    #[Route('/brand/edit/{brand}', name: 'app_brand_form_edit')]
    // type fonction donc form
    // ":" qu'est ce que ça retourne
    public function brandForm(
	    // injection de dépendance, connexion BDD
		// $em : lien avec la BDD
        EntityManagerInterface $em,
	    // requête qu'on recoit du client
        Request $request,
	    // objet qu'on veut crée ou mettre à jour
	    // le brand peut être nul
		?Brand $brand = null
    ): Response {
		if (!$brand) {
			$brand = new Brand();
		}
	
	    // $form dans AbstractController, créer un objet/variable
	    // $this = instance de controleur
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);
	
	    //si j'ai reçu des données
	    // "isValid" : contrainte mise à jour supérieur à la création, vérifie
	    if ($form->isSubmitted() && $form->isValid()) {
		    // prépare une insertion transfert à la BDD (pr l'instant fait rien), controle
		    $em->persist($brand);
		    // vzy écrit mtn à la BDD
            $em->flush();
        }
	
	    // si j'ai rien reçu
	
	    // controleur : prendre les data et renvoie à la vue (seulement visuel)
	    // $this = fait moi la réponse
        return $this->render('home/brand_form.html.twig', [
            'leFormDuController' => $form->createView(),
        ]);
    }
}

// debug barre s'affiche quand c'est du html
// plante : twig (rendu visuel)