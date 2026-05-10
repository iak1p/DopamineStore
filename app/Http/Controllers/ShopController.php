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

    // public function index(Request $request)
    // {
    //     $selectedCategory = $request->query('category');
    //     $sort = $request->query('sort');
    //     $search = trim($request->query('search', ''));

    //     $query = Product::with('images');

    //     if ($search !== '') {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('name', 'like', '%' . $search . '%')
    //                 ->orWhere('category', 'like', '%' . $search . '%');
    //         });
    //     }

    //     if ($selectedCategory) {
    //         $query->where('category', $selectedCategory);
    //     }

    //     if ($sort === 'price_asc') {
    //         $query->orderBy('price', 'asc');
    //     } elseif ($sort === 'price_desc') {
    //         $query->orderBy('price', 'desc');
    //     }

    //     $products = $query->paginate(8)->withQueryString();

    //     $categories = [
    //         ['slug' => 'stone', 'name' => 'Stone fruits'],
    //         ['slug' => 'exotic', 'name' => 'Exotic fruits'],
    //         ['slug' => 'citrus', 'name' => 'Citrus fruits'],
    //         ['slug' => 'pome', 'name' => 'Pome fruits'],
    //         ['slug' => 'boxes', 'name' => 'Boxes'],
    //     ];

    //     return view('shop', compact('products', 'categories', 'selectedCategory', 'sort', 'search'));
    // }

    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $sort = $request->query('sort');
        $search = trim($request->query('search', ''));

        $priceMin = $request->query('price_min');
        $priceMax = $request->query('price_max');
        $stock = $request->query('stock');

        $query = Product::with('images');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        if ($priceMin !== null && $priceMin !== '') {
            $query->where('price', '>=', $priceMin);
        }

        if ($priceMax !== null && $priceMax !== '') {
            $query->where('price', '<=', $priceMax);
        }

        if ($stock === 'instock') {
            $query->where('stock', '>', 0);
        } elseif ($stock === 'soldout') {
            $query->where('stock', '<=', 0);
        }

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8)->withQueryString();

        $categories = [
            ['slug' => 'stone', 'name' => 'Stone fruits'],
            ['slug' => 'exotic', 'name' => 'Exotic fruits'],
            ['slug' => 'citrus', 'name' => 'Citrus fruits'],
            ['slug' => 'pome', 'name' => 'Pome fruits'],
            ['slug' => 'boxes', 'name' => 'Boxes'],
        ];

        return view('shop', compact(
            'products',
            'categories',
            'selectedCategory',
            'sort',
            'search',
            'priceMin',
            'priceMax',
            'stock'
        ));
    }

    // поиск
    public function suggestions(Request $request)
    {
        $search = trim($request->query('search', ''));

        if ($search === '') {
            return response()->json([]);
        }

        $products = Product::with('images')
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            })
            ->limit(5)
            ->get()
            ->map(function ($product) {
                $firstImage = $product->images->first();

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'category' => $product->category,
                    'price' => $product->price,
                    'image' => asset('storage/' . $firstImage->image_path),
                    'alt' => $firstImage?->alt_text ?? $product->name,
                ];
            });

        return response()->json($products);
    }
}
