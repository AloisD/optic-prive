<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    #[Route('/stripe', name: 'stripe')]
    public function index(): Response
    {
      // On s'identifie
      $stripe = new \Stripe\StripeClient(
        'sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7'
      );
      // On doit créer un compte connecté au préalable et définir l'id du compte connecté dans 'account'
      $stripe->accountLinks->create([
        'account' => 'acct_1KWH2fKbyvosjtSd',
        'refresh_url' => 'https://example.com/reauth',
        'return_url' => 'https://example.com/return',
        'type' => 'account_onboarding',
      ]);

        \Stripe\Stripe::setApiKey('sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7');

        /*$payment_intent = \Stripe\PaymentIntent::create([
          'payment_method_types' => ['card'],
          'amount' => 1000,
          'currency' => 'eur',
          'application_fee_amount' => 123,
        ], ['stripe_account' => 'acct_1KUUW2IbT27Lah12']);*/

        $product = $stripe->products->create([
          'name' => 'Gold',
          "metadata" => [
            "reference" => "G34543",
            "color_code" => "BFVDFGDF"
          ],
        ]);
        // dd($product->id);

        $price = $stripe->prices->create([
          'unit_amount' => 30000,
          'currency' => 'eur',
          'product' => $product->id,
        ]);
        // dd($price->id);

        $stripe->charges->create([
          "amount" => 2000,
          "currency" => "eur",
          "source" => "tok_amex", // obtained with Stripe.js
          "metadata" => ["order_id" => "6735"]
        ]);

        $session = $stripe->checkout->sessions->create([
          'success_url' => 'https://example.com/success',
          'cancel_url' => 'https://example.com/cancel',
          'line_items' => [
            [
              'price' => $price->id,
              'quantity' => 2,
            ],
          ],
          'mode' => 'payment',
        ]);
        // dd($session);
        return $this->render('stripe/index.html.twig');
    }
}
