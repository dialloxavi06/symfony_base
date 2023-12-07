<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marque; // Assurez-vous d'importer la classe Marque depuis votre application

class MarqueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $marques = [
            'Addidas', 'Nike', 'Puma', 'SFR', 'Lenovo',
            'Apple', 'Samsung', 'Sony', 'Microsoft', 'Google',
            'Adidas', 'Asus', 'HP', 'Dell', 'Acer',
            'Coca-Cola', 'Pepsi', 'McDonald\'s', 'Burger King', 'KFC'
        ];

        foreach ($marques as $nomMarque) {
            $marque = new Marque();
            $marque->setNom($nomMarque);

            $manager->persist($marque);
        }

        $manager->flush();
    }
}
