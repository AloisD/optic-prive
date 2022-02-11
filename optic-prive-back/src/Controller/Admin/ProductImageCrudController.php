<?php

namespace App\Controller\Admin;

use App\Entity\ProductImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProductImageCrudController extends AbstractCrudController
{
    public const PRODUCTS_BASE_PATH = '/images/products';
    public const PRODUCTS_UPLOAD_DIR = 'public/images/products';

    public static function getEntityFqcn(): string
    {
        return ProductImage::class;
    }

    public function configureFields(string $pageName): iterable
    {
      yield AssociationField::new('product');
      yield ImageField::new('path')
        ->setBasePath(self::PRODUCTS_BASE_PATH)
        ->setUploadDir(self::PRODUCTS_UPLOAD_DIR);
    }
}
