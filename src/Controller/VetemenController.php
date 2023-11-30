<?php


namespace App\Controller;

use App\Entity\Vetement;
use App\Repository\VetementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VetemenType;




class VetemenController extends AbstractController
{
    /**
     * function indexing Vetement
     *
     * @param VetementRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/vetements', name: 'vetement_index', methods: ['GET'])]
    public function index(VetementRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $vetements = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('vetemen/index.html.twig', [
            'vetements' => $vetements,
        ]);
    }

  

    /**
     * function ajout nouveau vetement
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('vetemen/new', name: 'vetement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vetement = new Vetement();
        $form = $this->createForm(VetemenType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vetement);
            $entityManager->flush();

            return $this->redirectToRoute('vetement_index');
        }

        return $this->render('vetemen/new.html.twig', [
            'vetement' => $vetement,
            'form' => $form->createView(),
        ]);
    }


    /**
     * function edit vetement
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/vetements/{id}/edit', name: 'vetement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VetemenType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vetement_index');
        }

        return $this->render('vetement/edit.html.twig', [
            'vetement' => $vetement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * function delete vetement
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */

    #[Route('/vetements/{id}', name: 'vetement_delete', methods: ['DELETE'])]
    public function delete(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vetement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vetement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vetement_index');
    }
}
