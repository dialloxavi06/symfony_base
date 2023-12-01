<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChaussureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;



class ChaussureController extends AbstractController
{
    #[Route('/chaussure', name: 'app_chaussure')]
    public function index(ChaussureRepository $chossureRepository,  PaginatorInterface $paginator, Request $request ): Response
    {

        $chaussures = $paginator->paginate(
            $chossureRepository->findAll(),
            $request->query->getInt('page', 1),
            7
        );
        return $this->render('chaussure/index.html.twig', [
            'chaussures' => $chaussures,
        ]);
    } 
}
