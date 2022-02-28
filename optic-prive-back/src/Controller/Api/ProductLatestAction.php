<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class ProductLatestAction extends AbstractController
{
  const MAX_LATEST_PRODUCTS = 5;

  private $productRepository;


  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }
  public function __invoke($data)
  {
    $data = $this->productRepository->getLatestProducts(self::MAX_LATEST_PRODUCTS);
    return $data;
  }
}
