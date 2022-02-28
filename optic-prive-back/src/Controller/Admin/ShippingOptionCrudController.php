<?php

namespace App\Controller\Admin;

use App\Entity\ShippingOption;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShippingOptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShippingOption::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Options de transport')
            ->setPageTitle('new', 'Ajouter un mode d\'expédition')
            ->setEntityLabelInSingular('Option de transport')
            ->setEntityLabelInPlural('Options de transport')
            ->setEntityPermission('ROLE_ADMIN')
            ->setSearchFields(null)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name', 'Nom');
        yield NumberField::new('price', 'Prix en €');
    }
}
