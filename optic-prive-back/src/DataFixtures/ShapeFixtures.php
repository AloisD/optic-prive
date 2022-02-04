<?php

namespace App\DataFixtures;

use App\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShapeFixtures extends Fixture
{
    public const SHAPE_SQUARE = "square";
    public const SHAPE_OVAL = "oval";
    public const SHAPE_PILOT = "pilot";
    public const SHAPE_BUTTERFLY = "butterfly";
    public const SHAPE_ROUND = "round";
    public const SHAPE_RECTANGLE = "rectangle";


    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();

        $shape1 = new Shape();
        $shape1
            ->setName("square")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_SQUARE, $shape1);
        $manager->persist($shape1);

        $shape2 = new Shape();
        $shape2
            ->setName("oval")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_OVAL, $shape2);
        $manager->persist($shape2);

        $shape3 = new Shape();
        $shape3
            ->setName("pilot")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_PILOT, $shape3);
        $manager->persist($shape3);

        $shape4 = new Shape();
        $shape4
            ->setName("butterfly")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_BUTTERFLY, $shape4);
        $manager->persist($shape4);

        $shape5 = new Shape();
        $shape5
            ->setName("round")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_ROUND, $shape5);
        $manager->persist($shape5);

        $shape6 = new Shape();
        $shape6
            ->setName("rectangle")
            ->setLogo($faker->imageUrl(640, 480, 'animals', true));
          $this->setReference(self::SHAPE_RECTANGLE, $shape6);
        $manager->persist($shape6);

        $manager->flush();
    }
}
