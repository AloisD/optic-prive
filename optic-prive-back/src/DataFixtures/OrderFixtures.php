<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = \Faker\Factory::create();

    for ($p = 0; $p < random_int(5, 15); $p++) {
      $order = new Order();
      $order
        ->setCreatedAt(new \DateTimeImmutable())
        ->setUpdatedAt(new \DateTimeImmutable());

      $orderStatus = $this->getOrderStatusRandom();
      $order->setOrderStatus($orderStatus);

      $manager->persist($order);
    }

    $manager->flush();
  }

  // get random order status
  private function getOrderStatusRandom(): string
  {
    $items = ['orderCancelled', 'orderDelivered', 'orderInTransit', 'orderPaymentDue','orderPickupAvailable', 'orderProblem', 'orderProcessing', 'orderReturned'];
    return $items[random_int(0, 7)];
  }
}
