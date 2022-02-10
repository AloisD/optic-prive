<?php

namespace App\Controller\Admin;

use App\Entity\LensType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LensTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LensType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
    }
}
