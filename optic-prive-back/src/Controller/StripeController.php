<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\BrandRepository;
use App\Repository\OrderHasProductRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    // Créer un produit
    #[Route('/stripe/create-product', name: 'stripe_product')]
    public function createProduct(): Response
    {
        $stripe = new \Stripe\StripeClient(
          'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
        );
        $products = $stripe->products->all(['limit' => 3]);
        dd($products);
        $stripe->products->create([
          'name' => 'Gold Special',
          "metadata" => [
            "reference" => "G34543",
            "color_code" => "BFVDFGDF"
          ]
        ]);
    }

    // Créer un prix
    #[Route('/stripe/create-price', name: 'stripe_price')]
    public function createPrice(): Response
    {
        $stripe = new \Stripe\StripeClient(
          'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
        );
        $price = $stripe->prices->create([
          'unit_amount' => 5476,
          'currency' => 'eur',
          'product' => 'prod_LDPzpwW7noWuFP',
        ]);
        dd($price);
        //$stripe->prices->all(['limit' => 3])
    }

    // Récupérer un prix
    #[Route('/stripe/get-price', name: 'stripe_get_price')]
    public function getPrice(): Response
    {
        $stripe = new \Stripe\StripeClient(
          'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
        );
        $stripePrice = $stripe->prices->retrieve(
          'price_1KWzGHIZjO3PUhvEzQulGEIJ',
          []
        );
        dd($stripePrice);
    }

    // Créer une session de paiement
    #[Route('/payment', name: 'payment', methods: 'POST')]
    public function index(Request $request, OrderHasProductRepository $orderHasProductRepository, ProductRepository $productRepository, BrandRepository $brandRepository): Response
    {
      dd($request);
      //récupérer les lignes de la commande
      $orderHasProduct = $orderHasProductRepository->find(1);
      $orderHasProduct1 = $orderHasProductRepository->find(2);

      //récupère les différents propriétés du produit
      $brand = $orderHasProduct->getProduct()->getBrand();
      $reference = $orderHasProduct->getProduct()->getReference();
      $colorCode = $orderHasProduct->getProduct()->getColorCode();
      $sellingPrice = $orderHasProduct->getProduct()->getSellingPrice();
      $quantity = $orderHasProduct->getProduct()->getQuantity();

      //récupère l'id de la commande
      $orderId = $orderHasProduct->getOrder()->getId();

      //récupère les différents propriétés du produit 1
      $brand1 = $orderHasProduct1->getProduct()->getBrand();
      $reference1 = $orderHasProduct1->getProduct()->getReference();
      $colorCode1 = $orderHasProduct1->getProduct()->getColorCode();
      $sellingPrice1 = $orderHasProduct1->getProduct()->getSellingPrice();
      $quantity1 = $orderHasProduct1->getProduct()->getQuantity();

      // On s'identifie
      $stripe = new \Stripe\StripeClient(
        'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
      );
      // On doit créer un compte connecté pour le client au préalable et définir l'id du compte connecté dans 'account'
      $stripe->accountLinks->create([
        'account' => 'acct_1KWH2fKbyvosjtSd',
        'refresh_url' => 'https://example.com/reauth',
        'return_url' => 'https://example.com/return',
        'type' => 'account_onboarding',
      ]);

      //on renseigne la clé secrète du dashboard
      \Stripe\Stripe::setApiKey('sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7');

      //création de produit
      $product = $stripe->products->create([
        'name' => $brand . " " . $reference,
        "metadata" => [
          "reference" => $reference,
          "color_code" => $colorCode,
          "seller_id" => '1'
        ],
      ]);
      // dd($product->id);

      $product1 = $stripe->products->create([
        'name' => $brand1 . " " . $reference1,
        "metadata" => [
          "reference" => $reference1,
          "color_code" => $colorCode1,
          "seller_id" => '2'
        ],
      ]);
      // dd($product->id);

      //création de prix
      $price = $stripe->prices->create([
        'unit_amount' => $sellingPrice * 100,
        'currency' => 'eur',
        'product' => $product->id,
      ]);
      // dd($price->id);

      $price1 = $stripe->prices->create([
        'unit_amount' => $sellingPrice1 * 100,
        'currency' => 'eur',
        'product' => $product1->id,
      ]);
      // dd($price->id);

      //création de frais
      $stripe->charges->create([
        "amount" => 2000,
        "currency" => "eur",
        "source" => "tok_amex", // obtained with Stripe.js
        "metadata" => ["order_id" => $orderId]
      ]);

      //on traite les données des produits et prix
      // $session = $stripe->checkout->sessions->create([
      //   'success_url' => 'https://example.com/success',
      //   'cancel_url' => 'https://example.com/cancel',
      //   'line_items' => [
      //     [
      //       'price' => $price->id,
      //       'quantity' => $quantity,
      //     ],
      //     [
      //       'price' => $price1->id,
      //       'quantity' => $quantity1,
      //     ],
      //   ],
      //   'mode' => 'payment',
      // ]);
      // dd($session);

      $stripe = new \Stripe\StripeClient(
        'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
      );
      $paymentLink = $stripe->paymentLinks->create([
        'line_items' => [
                [
                  'price' => $price->id,
                  'quantity' => $quantity,
                ],
                [
                  'price' => $price1->id,
                  'quantity' => $quantity1,
                ],
          ],
      ]);
      // dd($paymentLink);
      return $this->render('stripe/index.html.twig', [
        'url' => $paymentLink->url
      ]);
    }

    #[Route('/stripe/get-orders', name: 'stripe_get_orders')]
    public function findAllOrders(OrderHasProductRepository $orderHasProductRepository, ProductRepository $productRepository): Response
    {
        //dd($productRepository->find(14));
        $orderHasProduct = $orderHasProductRepository->find(1);
        // dd($orderHasProduct);
        if ($orderHasProduct->getProduct()) {
          $id = $orderHasProduct->getProduct()->getId();
          //dd($id);
          $product = $productRepository->findOneById($id);
          dd($product);
        }
        dd("ok");
    }
}
