<?php

namespace App\Controller\Admin;

use App\Entity\BusinessUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BusinessUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BusinessUser::class;
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
