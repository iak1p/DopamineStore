<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($name)
    {
        $products = collect([
            [
                'name' => 'Orange',
                'description' => 'Citrus fruit • 1 kg',
                'price' => 2.80,
                'image' => '/phase1/templates/assets/img/orange.png',
                'category' => 'citrus-fruits',
                'stock' => 'instock',
                'link' => '/product/orange',
            ],
            [
                'name' => 'Apple',
                'description' => 'Pome fruit • 1 kg',
                'price' => 3.20,
                'image' => '/phase1/templates/assets/img/apple.png',
                'category' => 'pome-fruits',
                'stock' => 'instock',
                'link' => '/product/apple',
            ],
            [
                'name' => 'Peach',
                'description' => 'Stone fruit • 1 kg',
                'price' => 4.10,
                'image' => '/phase1/templates/assets/img/peach.png',
                'category' => 'stone-fruits',
                'stock' => 'instock',
                'link' => '/product/peach',
            ],
            [
                'name' => 'Lemon',
                'description' => 'Citrus fruit • 1 kg',
                'price' => 2.80,
                'image' => '/phase1/templates/assets/img/orange.png',
                'category' => 'citrus-fruits',
                'stock' => 'instock',
                'link' => '/product/lemon',
            ],
        ]);

        $product = $products->firstWhere('name', ucfirst($name));

        if (!$product) {
            abort(404);
        }

        return view('product', compact('product'));
    }
}
