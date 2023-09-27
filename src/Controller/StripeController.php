<?php

namespace App\Controller;

use App\classe\cart;
use App\Entity\Produits;
use App\Entity\Reservation;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class StripeController extends AbstractController
{
    #[Route('/stripe/{reference}', name: 'app_stripe')]
    public function index(cart $cart, EntityManagerInterface $entityManager, $reference)
    {
        $products_for_stripe  = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';



        foreach ($cart->getfull() as $Produits) {

            $products_for_stripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $Produits['produit']->getPrix() * 100,
                    'product_data' => [
                        'name' => $Produits['produit']->getcategory(),
                        'images' => [$YOUR_DOMAIN . "/puplic" . $Produits['produit']->getphoto()],
                    ],
                ],


                'quantity' => $Produits['quantity'],

            ];



            Stripe::setApikey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');
            $chekout_session = Session::create([
                'payment_method_types' => ['card'],

                'line_items' => [
                    $products_for_stripe,
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/success.html',
                'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
            ]);


            return $this->redirect($chekout_session->url, 303);
        }
    }
}
