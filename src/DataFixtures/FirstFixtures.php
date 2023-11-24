<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\First;
use Faker\Factory;


class FirstFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
     
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 100; $i++) {
            $personne = new First();          
            $personne->setNom($faker->name);
            $personne->setPrenom($faker->numberBetween(1,10));
            $manager->persist($personne);
        }


        $manager->flush();
    }
}
