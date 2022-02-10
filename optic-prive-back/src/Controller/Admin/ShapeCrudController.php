<?php

namespace App\Controller\Admin;

use App\Entity\Shape;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ShapeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Shape::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
    }
}
