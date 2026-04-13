<?php

namespace App\Http\Controllers;

use App\Helpers\ShippingHelper;
use App\Helpers\StripeCheckout;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;


class CheckoutPaymentController extends Controller
{


    /**
     * Undocumented function
     *
     * @param [type] $payment
     * @return void
     */
    public function index($payment)
    {

        // Get groups
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        // Get user
        $user = Auth::user();

        //Create variables
        $shipping_helper = new ShippingHelper();
        $stripe_checkout = new StripeCheckout();
        $order = new Order();
        $insert_data = [];
        $compeleted = false;

        // Get products
        $cart_data = $user->products()->withPrices()->get();


        // Check if cart is empty
        if ($cart_data->isEmpty()) {
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }

        // Get subtotal
        $cart_data->calculateSubtotal();

        // Determine payment
        switch ($payment) {
            case 'stripe':
                # code...

                $stripe_checkout->startCheckoutSession();
                $stripe_checkout->addEmail($user->email);
                $stripe_checkout->addProducts($cart_data);
                $stripe_checkout->addPointsCoupon();
                $stripe_checkout->enablePromoCodes();
                $shipping_data = $shipping_helper->getGroupShippingOptions();
                $stripe_checkout->addShippingOptions($shipping_data);
                $stripe_checkout->createSession();
                $insert_data = $stripe_checkout->getOrderCreateData();
                $completed = true;

                break;

            default:
                $insert_data = [
                    'payment_provider' => 'testing',
                    'payment_id' => 'testing',
                ];
                $completed = true;
                break;
        }

        // Validate
        if (!$completed || empty($insert_data)) {
            dd('Payment is incomplete or checkout is missing');
        }

        // Create order
        $order->user_id = $user->id;

        $lastOrder = Order::latest()->first();
        $order->order_no = $lastOrder
            ? $lastOrder->order_no + 1
            : 1234;

        $order->subtotal = $cart_data->getSubtotal();
        $order->total = $cart_data->getTotal();
        $order->payment_provider = $insert_data['payment_provider'];
        $order->payment_id = $insert_data['payment_id'];
        $order->shipping_id = 1;
        $order->shipping_address_id = 1;
        $order->billing_address_id = 1;
        $order->payment_status = 'unpaid';
        $order->save();


        // Create order details
        $records = [];

        foreach ($cart_data as $data) {
            array_push(
                $records,
                new OrderProduct(
                    [
                        'product_id' => $data->id,
                        'user_id' => $user->id,
                        'price' => $data->getPrice(),
                        'quantity' => $data->pivot->quantity,
                    ]
                )
            );
        }


        $order->order_products()->saveMany($records);

        // Redirect
        if ($payment == 'stripe') {
            return redirect($stripe_checkout->getUrl());
        }

        dd('Payment was successful during testing');
    }
}
