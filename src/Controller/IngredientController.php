<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



class IngredientController extends AbstractController
{
  /**
 * function display all ingredients
 * 
 * @param IngredientRepository $repository
 * @param PaginatorInterface $paginator
 * @param Request $request
 * @return Reponse
 */
    #[Route('/ingredient', name: 'app_ingredient', methods: ['GET'])]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $ingredients= $paginator->paginate(
        $repository->findAll(),
        $request->query->getInt('page', 1), 
        10
    );
        return $this->render('ingredient/index.html.twig',
        ['ingredients'=> $ingredients]
        );
    }
    #[Route('/new', name: 'app_ingredient_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
    
            // Then, persist and flush the data
            $manager->persist($ingredient);
            $manager->flush();
    
            // Now, you can dump or process the ingredient data
            dd($ingredient);
    
            $this->addFlash(
                'success',
                'Votre ingrédient a été créé avec succès!'
            );
    
            return $this->redirectToRoute('app_ingredient');
        }
    
        return $this->render('ingredient/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

} 
