<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\LensType;
use App\Entity\Product;
use App\Entity\Segment;
use App\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

  public function load(ObjectManager $manager): void
  {
    $faker = \Faker\Factory::create();

    $product = new Product();
    $product
      ->setName("aviator classic")
      ->setReference('RB3025 L0205 58-14')
      ->setColorCode('poli or:vert') // monture color : glasses color
      ->setRetailPrice($faker->randomFloat(1, 10, 30))
      ->setSellingPrice($faker->randomFloat(1, 10, 30))
      ->setQuantity($faker->randomNumber(1, true));

    $this->getDataProduct($product, $faker);

    //brand
    $brand = new Brand();
    $brand
      ->setName("Hugo Boss")
      ->setLogo("https://fr.wikipedia.org/wiki/Hugo_Boss#/media/Fichier:HUGO-BOSS_POS.png");
    $manager->persist($brand);

    //shape
    $shape = new Shape();
    $shape
      ->setName("square")
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($shape);

    //segment
    $segment = new Segment();
    $segment
      ->setName($faker->word())
      ->setLogo($faker->imageUrl(640, 480, 'animals', true));
    $manager->persist($segment);

    //lens_type
    $lensType = new LensType();
    $lensType
      ->setName($faker->word());
    $manager->persist($lensType);


    $product
      ->setBrand($brand)
      ->setShape($shape)
      ->setSegment($segment)
      ->setLensType($lensType);

    $manager->persist($product);
    $manager->flush();
  }

  private function getDataProduct(Product $product, $faker)
  {
    $state = $this->getStatusRandom();
    $product->setState($state);

    $category = $this->getCategoryRandom();
    $product->setCategory($category);

    $uvProtection = $this->getUvProtectionRandom();
    $product->setUvProtection($uvProtection);

    $itemAvailability = $this->getItemAvailabilityRandom();
    $product->setItemAvailability($itemAvailability);

    $eyeSize = $this->getEyeSizeRandom($faker);
    $product->setEyeSize($eyeSize);

    $bridgeSize = $this->getBridgeSizeRandom($faker);
    $product->setBridgeSize($bridgeSize);

    $templeLength = $this->getTempleLengthRandom($faker);
    $product->setTempleLength($templeLength);
  }


  /** Product *****************************************************************************/

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

  private function getItemAvailabilityRandom(): string
  {
    $items = ['backOrder', 'discontinued', 'inStock', 'inStoreOnly', 'limitedAvailability', 'onlineOnly', 'outOfStock', 'preOrder', 'preSale', 'soldOut'];
    return $items[random_int(0, 9)];
  }

  private function getEyeSizeRandom($faker)
  {
    return $faker->numberBetween(7, 20);
  }

  private function getBridgeSizeRandom($faker)
  {
    return $faker->numberBetween(7, 20);
  }

  private function getTempleLengthRandom($faker)
  {
    return $faker->numberBetween(5, 20);
  }

  /**END  Product************************************************************************* */
}
