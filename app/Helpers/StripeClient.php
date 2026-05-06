<?php

namespace App\Helpers;

class StripeClient
{
    public static function getClient()
    {
        $secret = trim(env('STRIPE_SECRET', ''));

        if (empty($secret)) {
            throw new \RuntimeException('Stripe secret key is not configured. Please set STRIPE_SECRET in your .env file.');
        }

        return new \Stripe\StripeClient($secret);
    }
}
