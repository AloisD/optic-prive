<?php

namespace App\Controller\Api;

use App\Classe\PrepareStripe;
use App\Repository\OrderHasProductRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ShippingOptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class PaymentAction extends AbstractController
{

  private $manager;
  private $userRepository;
  private $shippingOptionRepository;
  private $productRepository;
  private $orderHasProductRepository;
  private $orderRepository;

  public function __construct(
    EntityManagerInterface $manager,
    UserRepository $userRepository,
    ShippingOptionRepository $shippingOptionRepository,
    ProductRepository $productRepository,
    OrderHasProductRepository $orderHasProductRepository,
    OrderRepository $orderRepository
  ) {
    $this->manager = $manager;
    $this->userRepository = $userRepository;
    $this->shippingOptionRepository = $shippingOptionRepository;
    $this->productRepository = $productRepository;
    $this->orderHasProductRepository = $orderHasProductRepository;
    $this->orderRepository = $orderRepository;
  }

  public function __invoke($data, Request $request)
  {
    $data = json_decode($request->getContent());

    $prepareStripe = new PrepareStripe(
      $this->manager,
      $this->userRepository,
      $this->shippingOptionRepository,
      $this->productRepository,
      $this->orderHasProductRepository,
      $this->orderRepository
    );
    $orderId = $prepareStripe->getIdOrder($data);
    return $prepareStripe->payment($orderId);
  }
}
