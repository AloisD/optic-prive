<?php

namespace App\Classe;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\OrderHasProduct;
use App\Repository\AddressRepository;
use App\Repository\OrderHasProductRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\ShippingOptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class PrepareStripe
{
  private $manager;
  private $userRepository;
  private $shippingOptionRepository;
  private $productRepository;
  private $orderHasProductRepository;
  private $orderRepository;
  private $addressRepository;

  public function __construct(
    EntityManagerInterface $manager,
    UserRepository $userRepository,
    ShippingOptionRepository $shippingOptionRepository,
    ProductRepository $productRepository,
    OrderHasProductRepository $orderHasProductRepository,
    OrderRepository $orderRepository,
    AddressRepository $addressRepository
  ) {
    $this->manager = $manager;
    $this->userRepository = $userRepository;
    $this->shippingOptionRepository = $shippingOptionRepository;
    $this->productRepository = $productRepository;
    $this->orderHasProductRepository = $orderHasProductRepository;
    $this->orderRepository = $orderRepository;
    $this->addressRepository = $addressRepository;
  }


  public function getIdOrder($data)
  {

    //user
    if ($data->userId) {
      $user = $this->userRepository->find($data->userId);
    }

    if (!$user) {
      return null;
    }

    if(!isset($data->addressDeliveryId)) {
      return null;
    }

    //delivery_address
    $deliveryAddress = $this->addressRepository->find($data->addressDeliveryId);

    if (!$deliveryAddress) {
      return null;
    }
    /*
    $deliveryAddress
      ->setName($data->delivery->address_name)
      ->setRecipient($data->delivery->address_name)
      ->setCountry($data->delivery->country)
      ->setCity($data->delivery->city)
      ->setUser($user)
      ->setFirstname($data->delivery->firstname)
      ->setLastname($data->delivery->lastname);
    $this->manager->persist($deliveryAddress);
    */

    if($data->isSameAddressBilling || (isset($data->addressDeliveryId) && ( isset($data->addressBillingId) && ($data->addressBillingId == $data->addressDeliveryId)) ) ) {
      // invoicing_address
      $invoicingAddress = $deliveryAddress;
    } else {
      if(isset($data->addressBillingId)) {
        $invoicingAddress = $this->addressRepository->find($data->addressBillingId);
      }
    }

    //tester le else
    //shipping
    if ($data->shippingId) {
      $shippingOption = $this->shippingOptionRepository->find($data->shippingId);
    }

    // order
    $order = new Order();
    $order
      ->setInvoicingAddress($invoicingAddress)
      ->setDeliveryAddress($deliveryAddress)
      ->setShipping($shippingOption)
      ->setOrderStatus('orderPaymentDue')
      ->setBuyer($user);

    $this->manager->persist($order);

    foreach ($data->products as $dataProduct) {
      $product = $this->productRepository->find($dataProduct->id);

      //orderHasProduct
      $orderHasProduct = new OrderHasProduct();
      $orderHasProduct
        ->setQuantity($dataProduct->quantityOrdered)
        ->setProduct($product)
        ->setOrder($order)
        ->setOrderHasProductStatus('orderProcessing'); // !!! to confirmed
      $this->manager->persist($orderHasProduct);
    }

    $this->manager->flush();
    return $order->getId();
  }


  private function initStripe()
  {

    // On s'identifie
    $stripe = new \Stripe\StripeClient(
      'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
    );
    // On doit cr??er un compte connect?? pour le client au pr??alable et d??finir l'id du compte connect?? dans 'account'
    $stripe->accountLinks->create([
      'account' => 'acct_1KWH2fKbyvosjtSd',
      'refresh_url' => 'https://example.com/reauth',
      'return_url' => 'https://example.com/return',
      'type' => 'account_onboarding',
    ]);

    //on renseigne la cl?? secr??te du dashboard
    \Stripe\Stripe::setApiKey('sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7');


    return $stripe;
  }

  public function payment(int $idOrder)
  {
    $order = $this->orderRepository->find($idOrder);

    $orderHasProducts = $this->orderHasProductRepository->findBy(['order' => $order]);
    $stripe = $this->initStripe();

    //cr??ation de frais
    $stripe->charges->create([
      "amount" => 2000,     // to confirmed
      "currency" => "eur",
      "source" => "tok_amex", // obtained with Stripe.js
      "metadata" => ["order_id" => $idOrder]
    ]);

    foreach ($orderHasProducts as $orderHasProduct) {
      //r??cup??re les diff??rents propri??t??s du produit
      $brand = $orderHasProduct->getProduct()->getBrand();
      $reference = $orderHasProduct->getProduct()->getReference();
      $colorCode = $orderHasProduct->getProduct()->getColorCode();
      $sellingPrice = $orderHasProduct->getProduct()->getSellingPrice();
      $quantity = $orderHasProduct->getQuantity();

      //cr??ation de produit
      $product = $stripe->products->create([
        'name' => $brand . " " . $reference,
        "metadata" => [
          "reference" => $reference,
          "color_code" => $colorCode,
          "seller_id" => $orderHasProduct->getProduct()->getSeller()->getId()
        ],
      ]);

      //cr??ation de prix
      $price = $stripe->prices->create([
        'unit_amount' => $sellingPrice * 100,
        'currency' => 'eur',
        'product' => $product->id,
      ]);

      $line_items[]  = [
        'price' => $price->id,
        'quantity' => $quantity,
      ];
    }

    $paymentLink = $stripe->paymentLinks->create([
      'line_items' => $line_items,
    ]);

    return ['url' => $paymentLink->url];
  }
}
