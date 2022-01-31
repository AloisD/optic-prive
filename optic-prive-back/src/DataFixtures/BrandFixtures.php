<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($p = 0; $p < random_int(5, 15); $p++) {
            $brand = new Brand();
            $brand
                ->setName($faker->word())
                ->setLogo($faker->imageUrl(640, 480, 'animals', true));

                $manager->persist($brand);
        }
        $manager->flush();
    }
}
