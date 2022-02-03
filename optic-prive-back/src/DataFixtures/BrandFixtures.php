<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
  public const BRAND_RAY_BAN = "ray-ban";
  public const BRAND_DOLCE_GABBANA = "dolce gabbana";

  public function load(ObjectManager $manager): void
  {

    $brand1 = new Brand();
    $brand1
      ->setName("ray-ban")
      ->setLogo("https://www.pngmart.com/files/5/Ray-Ban-Logo-PNG-File.png");
    $this->setReference(self::BRAND_RAY_BAN, $brand1);
    $manager->persist($brand1);

    $brand2 = new Brand();
    $brand2
      ->setName("dolce gabbana")
      ->setLogo("https://i.pinimg.com/originals/36/3c/29/363c29434e634cb6f9f39d49bfcfe7f2.png");
    $this->setReference(self::BRAND_DOLCE_GABBANA, $brand2);
    $manager->persist($brand2);

    $manager->flush();
  }
}
