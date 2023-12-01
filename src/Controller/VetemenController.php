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
use App\Entity\Image;
use App\Service\ImageUploader;






class VetemenController extends AbstractController
{


    public function __construct(private ImageUploader $imageUploader)
    {    }

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
            7
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
     public function new(Request $request, EntityManagerInterface $entityManager, ImageUploader $uploaderService): Response
     {
         $vetement = new Vetement();
         $form = $this->createForm(VetemenType::class, $vetement);
         $form->handleRequest($request);
     
         if ($form->isSubmitted() && $form->isValid()) {
             $imageFile = $form->get('image')->getData();
     
             // this condition is needed because the 'image' field is not required
             // so the image file must be processed only when a file is uploaded
             if ($imageFile) {
                 $directory = $this->getParameter('uploads_directory'); // Assurez-vous d'avoir le bon paramètre
                 $imageName = $uploaderService->upload($imageFile, $directory);
     
                 // Create a new Image entity and set its properties
                 $image = new Image();
                 $image->setChemin($imageName);
                 $image->setVetement($vetement);
     
                 // Persist and flush the entities
                 $entityManager->persist($image);
             }else {
             $this->addFlash('error', 'Impossible d\'ajouter ce vêtement');
         }
     
             $entityManager->persist($vetement);
             $entityManager->flush();
     
             $this->addFlash('success', 'Vêtement ajouté avec succès');
             return $this->redirectToRoute('vetement_index');
         } 
     
         return $this->render('vetemen/new.html.twig', [
             'form' => $form->createView(),
         ]);
     }


    /**
     * Function edit vetement
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/vetemen/{id}/edit', name: 'vetement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VetemenType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifiez si un nouveau fichier d'image est soumis
            $newImageFile = $form->get('image')->getData();

            if ($newImageFile) {
                // Supprimez l'ancienne image si elle existe
                $oldImages = $vetement->getImages();

                foreach ($oldImages as $oldImage) {
                    $oldImagePath = $this->getParameter('kernel.project_dir') . '/public/assets/image/' . $oldImage->getChemin();

                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }

                    $entityManager->remove($oldImage);
                }


                // Téléchargez la nouvelle image
                $newImageName = uniqid() . '.' . $newImageFile->guessExtension();
                $newImageFile->move($this->getParameter('kernel.project_dir') . '/public/assets/image', $newImageName);

                // Mettez à jour l'entité Image associée au vêtement
                $newImage = new Image();
                $newImage->setChemin($newImageName);
                $newImage->setVetement($vetement);
                $entityManager->persist($newImage);
            }

            // Enregistrez les modifications du vêtement
            $entityManager->flush();

            return $this->redirectToRoute('vetement_index');
        }

        return $this->render('vetemen/edit.html.twig', [
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

    #[Route('/vetemen/delete/{id}', name: 'vetement_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, Vetement $vetement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vetement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vetement);
            $entityManager->flush();

            // Ajoutez un message flash de succès
            $this->addFlash(
                'success',
                'Le vêtement a été supprimé avec succès.'
            );
        } else {
            // Ajoutez un message flash d'erreur
            $this->addFlash(
                'error',
                'Erreur lors de la suppression du vêtement.'
            );
        }

        // Redirige vers la page d'index des vetements
        return $this->redirectToRoute('vetement_index');
    }
}
