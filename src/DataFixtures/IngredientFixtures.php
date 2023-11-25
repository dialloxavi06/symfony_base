<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Créer 10 ingrédients avec des noms et des prix générés aléatoirement
        for ($i = 1; $i <= 10; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($faker->word);
            $ingredient->setPrice($faker->randomFloat(2, 1, 10)); // Prix entre 1 et 10 avec deux décimales
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
