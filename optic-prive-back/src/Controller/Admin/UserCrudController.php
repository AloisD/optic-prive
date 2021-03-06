<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
      yield FormField::addPanel('Id')->setColumns(6);
        yield IdField::new('id')->hideOnForm();
        yield EmailField::new('email');
        yield ArrayField::new('roles');//->setChoices(['administrateur' => 'ROLE_ADMIN', 'vendeur' => 'ROLE_PROFESSIONAL', 'client' => 'ROLE_CUSTOMER']);
      yield FormField::addPanel('Adresses')->setColumns(6);
        yield CollectionField::new('addresses')
          ->setEntryType(AddressType::class)
          ->hideOnIndex();
        yield DateTimeField::new('created_at')->hideOnForm();
        yield DateTimeField::new('updated_at')->hideOnForm();
    }
}
