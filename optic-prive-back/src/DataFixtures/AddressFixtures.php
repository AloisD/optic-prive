<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
      $faker = \Faker\Factory::create();

      for ($p = 0; $p < random_int(5, 15); $p++) {
          $address = new Address();
          $address
              ->setName($faker->address())
              ->setRecipient($faker->lastName())
              ->setCountry($faker->countryCode())
              ->setCity($faker->city())
              ->setStreet($faker->streetName())
              ->setNumber($faker->buildingNumber())
              ->setCompany($faker->company())
              ->setAdditionnalDetails($faker->paragraph())
              ->setCreatedAt(new \DateTimeImmutable())
              ->setUpdatedAt(new \DateTimeImmutable());

              $manager->persist($address);
      }
      $manager->flush();
  }
}
