<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSubscriber implements EventSubscriberInterface
{
  public function getSubscribedEvents(): array
  {
    return [
      Events::prePersist,
    ];
  }

  public function prePersist(LifecycleEventArgs $args): void
  {
    if(!$args->getObject() instanceof Product) {
      return;
    }

    $product = $args->getObject();
    $product->setName($product->getBrand(). " " . $product->getReference());

  }
}
