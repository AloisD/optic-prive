<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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

        yield FormField::addTab('Informations essentielles');
          yield FormField::addPanel('détails du produit');
            yield TextField::new('name', 'nom');
            yield AssociationField::new('brand', 'marque')->setColumns(3);/* ->autocomplete() use autocomplete if you have too many values causing "out of memory" errors */
            yield TextField::new('reference', 'référence')->setColumns(3);
            yield TextField::new('color_code', 'code couleur')->setColumns(3)->hideOnIndex();
            yield FormField::addRow();
            yield ChoiceField::new('category', 'catégorie')->setColumns(3)->setChoices(['Hommes' => 'male', 'Femmes' => 'female', 'Enfants' => 'child', 'Mixte' => 'unisex']);
            yield AssociationField::new('segment')->setColumns(3)->hideOnIndex();
            yield FormField::addRow();
            yield AssociationField::new('shape', 'forme')->setColumns(3)->hideOnIndex();
            yield AssociationField::new('color','couleur')->setColumns(3)->hideOnIndex();
            yield AssociationField::new('material', 'matériau')->setColumns(3)->hideOnIndex();
          yield FormField::addPanel('détails de l\'offre');
            yield NumberField::new('quantity', 'quantité')->setColumns(3);
            yield ChoiceField::new('state', 'état')->setColumns(3)->setChoices(['Damaged' => 'damagedCondition', 'New' => 'newCondition', 'Refurbished' => 'refurbishedCondition', 'Used' => 'usedCondition']);
            yield ChoiceField::new('ItemAvailability', 'disponibilité')->setColumns(3)->setChoices(['Discontinued' => 'discontinued', 'In stock' => 'inStock', 'Out of stock' => 'outOfStock'])->hideOnIndex();;
            yield FormField::addRow();
            yield NumberField::new('selling_price', 'prix demandé')->setColumns(3);
            yield NumberField::new('retail_price', 'prix en magasin')->setColumns(3)->hideOnIndex();

        yield FormField::addTab('Images');
          yield CollectionField::new('productImages', 'images du produit')
          ->setEntryType(ProductImageType::class)
          ->renderExpanded()
          ->hideOnIndex();

        yield FormField::addTab('Informations complémentaires');
        yield FormField::addPanel('détails');
            yield AssociationField::new('style', 'style')->setColumns(3)->hideOnIndex();
            yield ChoiceField::new('UvProtection', 'catégorie de filtration UV')->setColumns(3)->setChoices(['Aucune' => 'category0', 'cat 1' => 'category1', 'cat 2' => 'category2', 'cat 3' => 'category3', 'cat 4' => 'category4'])->hideOnIndex();
            yield AssociationField::new('lens_type', 'type de verres')->setColumns(3)->hideOnIndex();
          yield FormField::addPanel('taille');
            yield NumberField::new('eye_size', 'taille des verres')->setColumns(3)->hideOnIndex();
            yield NumberField::new('bridge_size', 'taille du pont')->setColumns(3)->hideOnIndex();
            yield NumberField::new('temple_length', 'taille des branches')->setColumns(3)->hideOnIndex();

        yield DateTimeField::new('created_at', 'date de création')->hideOnForm();
        yield DateTimeField::new('updated_at', 'dernière mise à jour')->hideOnForm();
    }
}
