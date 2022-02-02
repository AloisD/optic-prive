<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            ChoiceField::new('order_status')->setChoices(['Cancelled' => 'orderCancelled', 'Delivered' => 'orderDelivered', 'In Transit' => 'orderInTransit', 'Payment Due' => 'orderPaymentDue', 'Pickup Available' => 'orderPickupAvailable', 'Problem' => 'orderProblem', 'Processing' => 'orderProcessing', 'Returned' => 'orderReturned']),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Order) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('created_at'),
            DateField::new('updated_at'),
            TextField::new('order_status'),
        ];
    }
}
