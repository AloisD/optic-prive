<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('name');
        yield AssociationField::new('brand');/* ->autocomplete() use autocomplete if you have too many values causing "out of memory" errors */
        yield TextField::new('reference');
        yield TextField::new('color_code')->hideOnIndex();
        yield ChoiceField::new('category')->setChoices(['Male' => 'male', 'Female' => 'female', 'Child' => 'child', 'Unisex' => 'unisex']);
        yield AssociationField::new('segment')->hideOnIndex();
        yield AssociationField::new('shape')->hideOnIndex();
        yield AssociationField::new('lens_type')->hideOnIndex();
        yield AssociationField::new('style')->hideOnIndex();
        yield AssociationField::new('color')->hideOnIndex();
        yield AssociationField::new('material')->hideOnIndex();
        yield ChoiceField::new('UvProtection')->setChoices(['0' => 'category0', '1' => 'category1', '2' => 'category2', '3' => 'category3', '4' => 'category4'])->hideOnIndex();
        yield ChoiceField::new('ItemAvailability')->setChoices(['Discontinued' => 'discontinued', 'In stock' => 'inStock', 'Out of stock' => 'outOfStock'])->hideOnIndex();;
        yield ChoiceField::new('state')->setChoices(['Damaged' => 'damagedCondition', 'New' => 'newCondition', 'Refurbished' => 'refurbishedCondition', 'Used' => 'usedCondition']);
        yield MoneyField::new('selling_price')->setCurrency('EUR');
        yield MoneyField::new('retail_price')->setCurrency('EUR')->hideOnIndex();
        yield NumberField::new('quantity');
        yield NumberField::new('eye_size')->hideOnIndex();
        yield NumberField::new('bridge_size')->hideOnIndex();
        yield NumberField::new('temple_length')->hideOnIndex();
        yield DateTimeField::new('created_at')->hideOnForm();
        yield DateTimeField::new('updated_at')->hideOnForm();
    }

/*     public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        $entityInstance->setUpdatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    } */

/*     public function configureCrud(Crud $crud): Crud
    {
        return $crud
             ->setNumberFormat('%.2d');
    } */

}
