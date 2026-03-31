<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($slug)
    {
        $products = Product::with('images')->get();

        $product = $products->firstWhere('slug', $slug);

        if (!$product) {
            abort(404);
        }

        return view('product', compact('product'));
    }
}
