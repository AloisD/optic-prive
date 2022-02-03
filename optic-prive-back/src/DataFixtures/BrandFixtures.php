<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND_HUGO_BOSS = "Hugo Boss";
    public const BRAND_CHANEL = "Chanel";
    public const BRAND_DOLCE_GABBANA = "Dolce & Gabbana";
    public const BRAND_GIORGIO_ARMANI = "Giorgio Armani";
    public const BRAND_GUCCI = "Gucci";
    public const BRAND_GUESS = "Guess";
    public const BRAND_LACOSTE = "Lacoste";
    public const BRAND_PRADA = "Prada";
    public const BRAND_RAY_BAN = "Ray-Ban";

    public function load(ObjectManager $manager): void
    {
        $brand1 = new Brand();
        $brand1
            ->setName("Hugo Boss")
            ->setLogo("https://fr.wikipedia.org/wiki/Hugo_Boss#/media/Fichier:HUGO-BOSS_POS.png");
        $this->setReference(self::BRAND_HUGO_BOSS, $brand1);
        $manager->persist($brand1);

        $brand2 = new Brand();
        $brand2
            ->setName("Chanel")
            ->setLogo("https://fr.wikipedia.org/wiki/Chanel#/media/Fichier:Chanel_logo_complet.png");
        $this->setReference(self::BRAND_CHANEL, $brand2);
        $manager->persist($brand2);

        $brand3 = new Brand();
        $brand3
            ->setName("Dolce & Gabbana")
            ->setLogo("https://fr.wikipedia.org/wiki/Dolce_%26_Gabbana#/media/Fichier:Dolce_and_Gabbana.svg");
        $this->setReference(self::BRAND_DOLCE_GABBANA, $brand3);
        $manager->persist($brand3);

        $brand4 = new Brand();
        $brand4
            ->setName("Giorgio Armani")
            ->setLogo("https://fr.wikipedia.org/wiki/Giorgio_Armani_(entreprise)#/media/Fichier:Giorgio_Armani.svg");
        $this->setReference(self::BRAND_GIORGIO_ARMANI, $brand4);
        $manager->persist($brand4);

        $brand5 = new Brand();
        $brand5
            ->setName("Gucci")
            ->setLogo("https://fr.wikipedia.org/wiki/Gucci#/media/Fichier:Gucci_logo.svg");
        $this->setReference(self::BRAND_GUCCI, $brand5);
        $manager->persist($brand5);

        $brand6 = new Brand();
        $brand6
            ->setName("Guess")
            ->setLogo("https://fr.wikipedia.org/wiki/Guess_(entreprise)#/media/Fichier:Guess_logo.svg");
        $this->setReference(self::BRAND_GUESS, $brand6);
        $manager->persist($brand6);

        $brand7 = new Brand();
        $brand7
            ->setName("Lacoste")
            ->setLogo("https://fr.wikipedia.org/wiki/Lacoste_(entreprise)#/media/Fichier:Logo_lacoste.svg");
        $this->setReference(self::BRAND_LACOSTE, $brand7);
        $manager->persist($brand7);

        $brand8 = new Brand();
        $brand8
            ->setName("Prada")
            ->setLogo("https://fr.wikipedia.org/wiki/Prada_(entreprise)#/media/Fichier:Prada-Logo.svg");
        $this->setReference(self::BRAND_PRADA, $brand8);
        $manager->persist($brand8);

        $brand9 = new Brand();
        $brand9
            ->setName("Ray-Ban")
            ->setLogo("https://fr.wikipedia.org/wiki/Ray-Ban#/media/Fichier:Ray-Ban_logo.svg");
        $this->setReference(self::BRAND_RAY_BAN, $brand9);
        $manager->persist($brand9);

        $manager->flush();
    }
}
