<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('reference'),
            TextField::new('color_code')->hideOnIndex(),
            ChoiceField::new('category')->setChoices(['Male' => 'male', 'Female' => 'female', 'Child' => 'child', 'Unisex' => 'unisex']),
/*             ChoiceField::new('type')->setChoices(['Sunglasses' => 'sunglasses', 'Sport' => 'sport']), */
            ChoiceField::new('UvProtection')->setChoices(['0' => 'category0', '1' => 'category1', '2' => 'category2', '3' => 'category3', '4' => 'category4'])->hideOnIndex(),
            ChoiceField::new('ItemAvailability')->setChoices(['Discontinued' => 'discontinued', 'In stock' => 'inStock', 'Out of stock' => 'outOfStock']),
            ChoiceField::new('state')->setChoices(['Damaged' => 'damagedCondition', 'New' => 'newCondition', 'Refurbished' => 'refurbishedCondition', 'Used' => 'usedCondition']),
            MoneyField::new('selling_price')->setCurrency('EUR'),
            MoneyField::new('retail_price')->setCurrency('EUR')->hideOnIndex(),
            NumberField::new('quantity'),
            NumberField::new('eye_size')->hideOnIndex(),
            NumberField::new('bridge_size')->hideOnIndex(),
            NumberField::new('temple_length')->hideOnIndex(),


            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    }

/*     public function configureCrud(Crud $crud): Crud
    {
        return $crud
             ->setNumberFormat('%.2d');
    } */

}
