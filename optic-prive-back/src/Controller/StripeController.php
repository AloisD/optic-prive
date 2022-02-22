<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/stripe', name: 'stripe')]
    public function index(): Response
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient('sk_test_51KUUW2IbT27Lah12eKX8jFLJSDimpIFB8jwqdeAsFk8SIWy3EwcU0tqdy6PQAKBKiqziV9c6ExsT8WYYo2pTi1uM003PJ7XgI7');
        dump($stripe);

        $stripe->accounts->create(['type' => 'express']);

        $stripe->accountLinks->create([
          'account' => 'acct_1KUUW2IbT27Lah12',
          'refresh_url' => 'https://example.com/reauth',
          'return_url' => 'https://example.com/return',
          'type' => 'account_onboarding',
        ]);


        dd($stripe);

        return $this->render('stripe/index.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }
}
