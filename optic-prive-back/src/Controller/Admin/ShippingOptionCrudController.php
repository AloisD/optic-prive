<?php

namespace App\Controller\Admin;

use App\Entity\ShippingOption;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShippingOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShippingOption::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
