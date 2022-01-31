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
        ->setReference('réference' . $p)
        ->setColorCode($faker->word())
        ->setRetailPrice($faker->randomFloat(2))
        ->setSellingPrice($faker->randomFloat(2))
        ->setQuantity($faker->randomNumber(2, false))
        ->setCreatedAt(new \DateTimeImmutable())
        ->setUpdatedAt(new \DateTimeImmutable());

      $state = $this->getStatusRandom();
      $product->setState($state);

      $category = $this->getCategoryRandom();
      $product->setCategory($category);

      $uvProtection = $this->getUvProtectionRandom();
      $product->setUvProtection($uvProtection);

      $manager->persist($product);
    }

    $manager->flush();
  }

  // get random state
  private function getStatusRandom(): string
  {
    $items = ['damagedCondition', 'newCondition', 'refurbishedCondition', 'usedCondition'];
    return $items[random_int(0, 3)];
  }

  // get random category
  private function getCategoryRandom(): string
  {
    $items = ['male', 'female', 'child', 'unisex'];
    return $items[random_int(0, 3)];
  }

  // get random category
  private function getUvProtectionRandom(): string
  {
    $items = ['category0', 'category1', 'category2', 'category3', 'category4'];
    return $items[random_int(0, 4)];
  }
}
