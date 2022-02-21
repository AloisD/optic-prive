<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->hideOnIndex();
        yield TextField::new('recipient');
        yield CountryField::new('country');
        yield TextField::new('city');
        yield TextField::new('street')->hideOnIndex();;
        yield NumberField::new('number')->hideOnIndex();;
        yield TextField::new('company')->hideOnIndex();;
        yield TextareaField::new('additionnal_details')->hideOnIndex();;
    }
}
