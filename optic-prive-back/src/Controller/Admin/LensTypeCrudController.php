<?php

namespace App\Controller\Admin;

use App\Entity\LensType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LensTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LensType::class;
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
