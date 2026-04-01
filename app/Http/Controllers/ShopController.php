<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // public function index(Request $request)
    // {
    //     $selectedCategory = $request->query('category');
    //     $sort = $request->query('sort');

    //     $products = Product::with('images')->get();

    //     $query = Product::with('images');

    //     $pages = ceil(count($products) / 8);

    //     if ($selectedCategory) {
    //         $products = $products->where('category', $selectedCategory);
    //     }

    //     if ($sort === 'price_asc') {
    //         $products = $products->sortBy('price');
    //     } elseif ($sort === 'price_desc') {
    //         $products = $products->sortByDesc('price');
    //     }

    //     $products = $query->paginate(8)->withQueryString();

    //     $categories = [
    //         ['slug' => 'stone', 'name' => 'Stone fruits'],
    //         ['slug' => 'exotic', 'name' => 'Exotic fruits'],
    //         ['slug' => 'citrus', 'name' => 'Citrus fruits'],
    //         ['slug' => 'pome', 'name' => 'Pome fruits'],
    //         ['slug' => 'boxes', 'name' => 'Boxes'],
    //     ];

    //     return view('shop', compact('products', 'categories', 'selectedCategory', 'pages'));
    // }

    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $sort = $request->query('sort');

        // Строим запрос (НЕ get()!)
        $query = Product::with('images');

        // Фильтр по категории
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        // Сортировка
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        // Пагинация (8 товаров на страницу)
        $products = $query->paginate(8)->withQueryString();

        // Категории
        $categories = [
            ['slug' => 'stone', 'name' => 'Stone fruits'],
            ['slug' => 'exotic', 'name' => 'Exotic fruits'],
            ['slug' => 'citrus', 'name' => 'Citrus fruits'],
            ['slug' => 'pome', 'name' => 'Pome fruits'],
            ['slug' => 'boxes', 'name' => 'Boxes'],
        ];

        return view('shop', compact('products', 'categories', 'selectedCategory', 'sort'));
    }
}
