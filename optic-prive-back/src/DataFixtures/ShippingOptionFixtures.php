<?php

namespace App\DataFixtures;

use App\Entity\ShippingOption;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShippingOptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($p = 0; $p < random_int(5, 15); $p++) {
            $shippingOption = new ShippingOption();
            $shippingOption
                ->setName($faker->word())
                ->setPrice($faker->randomFloat(2, 0, 999.99));

                $manager->persist($shippingOption);
        }
        $manager->flush();
    }
}
