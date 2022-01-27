<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($p = 0; $p < random_int(5, 15); $p++) {
          $product = new Product();
          $product
            ->setName($faker->word())
            ->setReference('réference'. $p)
            ->setColorCode($faker->word())
            ->setRetailPrice($faker->randomFloat(2))
            ->setSellingPrice($faker->randomFloat(2))
            ->setQuantity($faker->randomNumber(2, false))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
            ;
          $manager->persist($product);
        }

        $manager->flush();
    }
}
