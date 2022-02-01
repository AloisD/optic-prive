<?php

namespace App\DataFixtures;

use App\Entity\Segment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SegmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        for ($p = 0; $p < random_int(5, 15); $p++) {
            $segment = new Segment();
            $segment
                ->setName($faker->word())
                ->setLogo($faker->imageUrl(640, 480, 'animals', true));

                $manager->persist($segment);
        }
        $manager->flush();
    }
}
