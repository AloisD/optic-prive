<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Entity\ProductImage;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class ProductImageAction extends AbstractController
{
  public function __invoke(Product $data, Request $request): Product
  {

    $uploadedFile = $request->files->get('image');

    if (!$uploadedFile) {
      throw new BadRequestHttpException('image is required');
    }
    $productImage = new ProductImage();
    $productImage->setPath($uploadedFile->getClientOriginalName());
    $productImage->setProduct($data);
    $data->addProductImage($productImage);

    return $data;
  }
}
