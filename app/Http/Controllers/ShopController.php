<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $sort = $request->query('sort');

        $products = Product::with('images')->get();

        // $products = collect([
        //     [
        //         'name' => 'Orange',
        //         'description' => 'Citrus fruit • 1 kg',
        //         'price' => 2.80,
        //         'image' => '/phase1/templates/assets/img/orange.png',
        //         'category' => 'citrus-fruits',
        //         'stock' => 'instock',
        //         'link' => '/product/orange',
        //     ],
        //     [
        //         'name' => 'Apple',
        //         'description' => 'Pome fruit • 1 kg',
        //         'price' => 3.20,
        //         'image' => '/phase1/templates/assets/img/apple.png',
        //         'category' => 'pome-fruits',
        //         'stock' => 'instock',
        //         'link' => '/product/apple',
        //     ],
        //     [
        //         'name' => 'Peach',
        //         'description' => 'Stone fruit • 1 kg',
        //         'price' => 4.10,
        //         'image' => '/phase1/templates/assets/img/peach.png',
        //         'category' => 'stone-fruits',
        //         'stock' => 'instock',
        //         'link' => '/product/peach',
        //     ],
        //     [
        //         'name' => 'Lemon',
        //         'description' => 'Citrus fruit • 1 kg',
        //         'price' => 2.80,
        //         'image' => '/phase1/templates/assets/img/orange.png',
        //         'category' => 'citrus-fruits',
        //         'stock' => 'instock',
        //         'link' => '/product/lemon',
        //     ],
        // ]);

        if ($selectedCategory) {
            $products = $products->where('category', $selectedCategory);
        }

        if ($sort === 'price_asc') {
            $products = $products->sortBy('price');
        } elseif ($sort === 'price_desc') {
            $products = $products->sortByDesc('price');
        }

        $categories = [
            ['slug' => 'stone-fruits', 'name' => 'Stone fruits'],
            ['slug' => 'exotic-fruits', 'name' => 'Exotic fruits'],
            ['slug' => 'citrus-fruits', 'name' => 'Citrus fruits'],
            ['slug' => 'pome-fruits', 'name' => 'Pome fruits'],
            ['slug' => 'boxes', 'name' => 'Boxes'],
        ];

        return view('shop', compact('products', 'categories', 'selectedCategory'));
        

        // return view('shop', compact('products'));
    }
}
