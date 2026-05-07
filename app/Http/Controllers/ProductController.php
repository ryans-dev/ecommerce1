<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\products\ProductFilter;
use App\Traits\PhpFlasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use PhpFlasher;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];

        $values = $request->query();

        $product_data = ProductFilter::withPrices()
            ->filter($values)
            ->paginate(9);
        $category_data = Product::distinct('category')->pluck('category');

        // $product_data = Product::withPrices()->filter($values)->paginate(9);

        return view('pages.default.productspage', compact('product_data', 'category_data'));
    }

    /**
     * Display a single product
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.default.product-detail', compact('product'));
    }
}
