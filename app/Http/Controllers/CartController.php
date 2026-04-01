<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart()->load('items.product.images');
        $categories = [
            ['slug' => 'stone', 'name' => 'Stone fruits'],
            ['slug' => 'exotic', 'name' => 'Exotic fruits'],
            ['slug' => 'citrus', 'name' => 'Citrus fruits'],
            ['slug' => 'pome', 'name' => 'Pome fruits'],
            ['slug' => 'boxes', 'name' => 'Boxes'],
        ];

        return view('cart', compact('cart', 'categories'));
        // return view('cart', compact('cart'));
    }
    private function getOrCreateCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        }

        return Cart::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    public function add(Product $product)
    {
        $cart = $this->getOrCreateCart();

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'unit_price' => $product->price,
            ]);
        }

        return redirect()->route('cart');
    }

    public function remove(CartItem $cartItem)
    {
        $cart = $this->getOrCreateCart();

        if ($cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart');
    }
}
