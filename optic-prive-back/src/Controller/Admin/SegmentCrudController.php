<?php

namespace App\Controller\Admin;

use App\Entity\Segment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SegmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Segment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
    }
}
