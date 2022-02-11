<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
        yield IdField::new('id')->hideOnForm();
        yield DateTimeField::new('created_at')->hideOnForm();
        yield DateTimeField::new('updated_at')->hideOnForm();
        yield ChoiceField::new('order_status')->setChoices(['Cancelled' => 'orderCancelled', 'Delivered' => 'orderDelivered', 'In Transit' => 'orderInTransit', 'Payment Due' => 'orderPaymentDue', 'Pickup Available' => 'orderPickupAvailable', 'Problem' => 'orderProblem', 'Processing' => 'orderProcessing', 'Returned' => 'orderReturned']);
        yield CollectionField::new('orderHasProducts');
        yield AssociationField::new('invoicing_address');
        yield AssociationField::new('delivery_address');
        yield AssociationField::new('shipping');
    }
}
