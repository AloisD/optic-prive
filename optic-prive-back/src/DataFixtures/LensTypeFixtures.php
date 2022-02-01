<?php

namespace App\DataFixtures;

use App\Entity\LensType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LensTypeFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
      $faker = \Faker\Factory::create();

      for ($p = 0; $p < random_int(5, 15); $p++) {
          $lensType = new LensType();
          $lensType
              ->setName($faker->word());

              $manager->persist($lensType);
      }
      $manager->flush();
  }
}
