<?php

namespace App\DataFixtures;

use App\Entity\ProductImage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductImageFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = \Faker\Factory::create();

    for ($p = 0; $p < random_int(5, 15); $p++) {
      $productImage = new ProductImage();
      $productImage
        ->setPath($faker->imageUrl(640, 480, 'animals', true))
        ->setCreatedAt(new \DateTimeImmutable())
        ->setUpdatedAt(new \DateTimeImmutable());

      $manager->persist($productImage);
    }

    $manager->flush();
  }
}
