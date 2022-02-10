<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
<<<<<<< HEAD
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
=======
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
>>>>>>> aafc90f1d632764cb7de1c12f0b28bd85f9d0922

class BrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Brand::class;
    }

<<<<<<< HEAD
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Brand) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    }
=======
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
>>>>>>> aafc90f1d632764cb7de1c12f0b28bd85f9d0922
}
