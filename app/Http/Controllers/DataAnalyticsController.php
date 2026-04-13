<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataAnalyticsController extends Controller
{
    public function index()
    {
        // Fetch analytics data to show on main analytics page
        $data = $this->getAnalyticsData();
        return view('data.analytics', $data);
    }

    public function printable()
    {
        // Fetch the same analytics data but load a print-friendly view
        $data = $this->getAnalyticsData();
        return view('data.analytics-printable', $data);
    }

    /**
     * Collect and calculate all analytics data required
     */
    private function getAnalyticsData()
    {
        /**
         * TOP 10 PRODUCTS (by total quantity sold)
         * Also calculates total revenue from each product
         */
        $topProducts = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select(
                'products.title',
                DB::raw('SUM(order_products.quantity) as total_quantity'),
                DB::raw('SUM(order_products.price * order_products.quantity) as total_revenue')
            )
            ->groupBy('order_products.product_id', 'products.title')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        // Summary stats calculated from top products
        $totalQuantity = $topProducts->sum('total_quantity');
        $totalRevenueValue = $topProducts->sum('total_revenue');
        $averageQuantity = round($topProducts->avg('total_quantity'), 2);
        $averageRevenue = round($topProducts->avg('total_revenue'), 2);

        // Highest performing product by quantity and revenue
        $topByQuantity = $topProducts->sortByDesc('total_quantity')->first();
        $topByRevenue = $topProducts->sortByDesc('total_revenue')->first();

        /**
         * TOP CUSTOMERS (by total amount spent)
         */
        $topCustomers = DB::table('order_products')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('SUM(order_products.price * order_products.quantity) as total_spent')
            )
            ->groupBy('orders.user_id', 'users.name')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();

        /**
         * REPEATED BUYERS (customers who placed more than 1 order)
         */
        $repeatedBuyers = DB::table('order_products')
            ->join('users', 'order_products.user_id', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('COUNT(DISTINCT order_products.order_id) as orders_count')
            )
            ->groupBy('order_products.user_id', 'users.name')
            ->having('orders_count', '>', 1)
            ->orderByDesc('orders_count')
            ->get();

        /**
         * MONTHLY TOTAL REVENUE
         */
        $monthlyRevenue = DB::table('order_products')
            ->selectRaw('DATE_FORMAT(created_at, "%M %Y") as month_name, SUM(price * quantity) as revenue')
            ->groupBy('month_name')
            ->orderByDesc('revenue')
            ->get();

        /**
         * MONTHLY TOTAL ORDERS
         */
        $monthlyOrders = DB::table('orders')
            ->selectRaw('DATE_FORMAT(created_at, "%M %Y") as month, COUNT(*) as total_orders')
            ->groupBy('month')
            ->orderByRaw('MIN(created_at) DESC')
            ->get();

        /**
         * PRODUCTS MOST FREQUENTLY INCLUDED IN ORDERS
         * (Counts orders per product, regardless of quantity)
         */
        $productsByOrderFrequency = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select(
                'products.title',
                DB::raw('COUNT(DISTINCT order_products.order_id) as orders_count')
            )
            ->groupBy('order_products.product_id', 'products.title')
            ->orderByDesc('orders_count')
            ->limit(10)
            ->get();

        /**
         * PRODUCTS BY NUMBER OF UNIQUE CUSTOMERS
         */
        $productsByUniqueCustomers = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->select(
                'products.title',
                DB::raw('COUNT(DISTINCT order_products.user_id) as unique_customers')
            )
            ->groupBy('order_products.product_id', 'products.title')
            ->orderByDesc('unique_customers')
            ->limit(10)
            ->get();

        /**
         * PRODUCTS WITH THE HIGHEST REPURCHASE RATE
         * - Calculates how many customers bought a product more than once
         * - repurchase_rate = (repurchasing_customers / total_customers) * 100
         */
        $productsByRepurchaseRate = DB::table('order_products')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            // Create subquery for user-level purchase counts per product
            ->join(DB::raw('
                (SELECT user_id, product_id, COUNT(DISTINCT order_id) as order_count
                FROM order_products
                GROUP BY user_id, product_id) as user_orders
            '), function ($join) {
                $join->on('order_products.user_id', '=', 'user_orders.user_id')
                    ->on('order_products.product_id', '=', 'user_orders.product_id');
            })
            ->select(
                'products.title',
                DB::raw('COUNT(DISTINCT order_products.user_id) as total_customers'),
                DB::raw('SUM(CASE WHEN user_orders.order_count > 1 THEN 1 ELSE 0 END) as repurchasing_customers'),
                DB::raw('(SUM(CASE WHEN user_orders.order_count > 1 THEN 1 ELSE 0 END) / COUNT(DISTINCT order_products.user_id)) * 100 as repurchase_rate')
            )
            ->groupBy('order_products.product_id', 'products.title')
            ->having('repurchasing_customers', '>', 0)
            ->orderByDesc('repurchase_rate')
            ->get();

        // Return all analytics values to views
        return compact(
            'topProducts',
            'totalQuantity',
            'totalRevenueValue',
            'averageQuantity',
            'averageRevenue',
            'topByQuantity',
            'topByRevenue',
            'topCustomers',
            'repeatedBuyers',
            'monthlyRevenue',
            'monthlyOrders',
            'productsByOrderFrequency',
            'productsByUniqueCustomers',
            'productsByRepurchaseRate'
        );
    }
}
