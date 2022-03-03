<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\SegmentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class ProductSegmentAction extends AbstractController
{
  private $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function __invoke(Product $data, $segmentName): Product
  {
    $data = $this->productRepository->getProductsBySegment($segmentName);
    return $data;

/*     if ($segmentName == 'solaires') {
      $data = $this->productRepository->getProductsBySegment(11);
      return $data;
    }
    if ($segmentName == 'sport') {
      $data = $this->productRepository->getProductsBySegment(12);
      return $data;
    }
    if ($segmentName == 'lumiere_bleue') {
      $data = $this->productRepository->getProductsBySegment(13);
      return $data;
    }
    if ($segmentName == 'vintage') {
      $data = $this->productRepository->getProductsBySegment(14);
      return $data;
    }
    if ($segmentName == 'accessoires') {
      $data = $this->productRepository->getProductsBySegment(15);
      return $data;
    }
    else {
      return error_log('segment does not exist in database');
    } */
  }
}
