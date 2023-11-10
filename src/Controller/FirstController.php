<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
 
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('/first/index.html.twig', [
            'name' => 'Mamadou',
            'firstname' => 'Diallo'
        ]);
        
    }
}
