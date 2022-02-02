<?php

namespace App\Controller\Admin;

use App\Entity\Segment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SegmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Segment::class;
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
