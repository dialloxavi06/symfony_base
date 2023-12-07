<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Vetement;
use App\Entity\Commentaire;
use App\Entity\Marque;
use App\Entity\Image;
use App\Entity\Price;

class VetementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Créer plusieurs Vetements
        for ($i = 1; $i <= 10; $i++) {
            $vetement = new Vetement();
            $vetement->setNom('Vetement ' . $i);
            $vetement->setDescription('This is a sample vetement ' . $i);
            $vetement->setTailles('M' . $i); // Remplacez cela par la logique que vous souhaitez
            $vetement->setCreatedAt(new \DateTimeImmutable());
            $vetement->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($vetement);

            // Créer des Commentaires pour chaque Vetement
            $commentaire1 = new Commentaire();
            $commentaire1->setContenu('Great vetement ' . $i . '!');
            $commentaire1->setVetement($vetement);
            $manager->persist($commentaire1);

            $commentaire2 = new Commentaire();
            $commentaire2->setContenu('Comfortable and stylish');
            $commentaire2->setVetement($vetement);
            $manager->persist($commentaire2);
            // Créer une marque pour chaque Vetement
            $marque = new Marque();
            $marque->setNom('Suppra' . $i);
            $vetement->setMarque($marque); // Link the brand to the clothing
            $manager->persist($marque);
             // Créer des prix Vetement
             $prix = new Price();
             $prix->setPrix(10,$i);
             $manager->persist($prix);

            // Associer une Image à chaque vetement
            $image = new Image();
            $image->setChemin('public/assets/image/_'.$i .'.jpg'); // Set the path to the image
            $image->setVetement($vetement); // Link the image to the clothing
            $manager->persist($image);


        }

        $manager->flush();
    }
}
