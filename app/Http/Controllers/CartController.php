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
            if ($cartItem->quantity < $product->stock) {
            $cartItem->increment('quantity');
            }else{
                return back()->with('error', 'Only ' . $product->stock . ' items available in stock.');
            }
        } else {
           if ($product->stock > 0) {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'unit_price' => $product->price,
            ]);
           }else {
            return back()->with('error', 'This product is out of stock.');
        }
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
    public function increase(CartItem $item)
    {
        $cart = $this->getOrCreateCart();

        if ($item->cart_id !== $cart->id) {
            abort(403);
        }

        if ($item->quantity < $item->product->stock) {
            $item->increment('quantity');
        } else {
            return back()->with('error', 'Only ' . $item->product->stock . ' items available in stock.');
        }

        return back();
    }

    public function decrease(CartItem $item)
    {
         $cart = $this->getOrCreateCart();
         
            if ($item->cart_id !== $cart->id) {
        abort(403);
    }
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }

        return back();
    }

}
