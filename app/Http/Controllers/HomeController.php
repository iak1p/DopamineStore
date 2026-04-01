<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $query = Product::with('images');

        $products = $query->paginate(4)->withQueryString();

        return view('home', compact('products'));
    }
}
