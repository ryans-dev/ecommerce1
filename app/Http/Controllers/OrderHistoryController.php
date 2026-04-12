<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {

        $order_data = Auth::user()
        ->orders()
        ->paidOrders()
        ->get()
        ;

        return view ('orders.order-history', compact('order_data'));
    }

    public function show(string $id)
    {

    $user = Auth::user();
    $address = Address::find(1);
    $order = Order::where('id', $id)
    ->where('user_id', $user->id)
    ->paidOrders()
    ->first();

    if(empty($order)){
        abort(404);
    }

    $product_data = $order->products;

        return view('orders.order-details', compact('user', 'order', 'address', 'product_data'));
    }
}
