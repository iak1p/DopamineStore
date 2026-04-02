<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    public function contact()
    {
        $cart = $this->getOrCreateCart()->load('items.product.images');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        return view('checkout.contact');
    }

    public function storeContact(Request $request)
    {
        $rules = [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:100'],
            'street' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'create_account' => ['required', 'boolean'],
            'note' => ['nullable', 'string'],
        ];

        if (!Auth::id()) {
            $rules['create_account'] = ['required', 'boolean'];
        }

       if (!Auth::id() && $request->input('create_account') == '1') {
            $rules['password'] = ['required', 'string', 'min:1', 'confirmed'];
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email'];
        }
        $validated = $request->validate($rules);

        $sessionId = session()->getId();

        if ($validated['create_account'] == '1' && !Auth::id()) {
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $this->attachSessionCartToUser($user, $sessionId);

            Auth::login($user);
        }

        session([
            'checkout_contact' => [
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'street' => $validated['street'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'create_account' => $validated['create_account'],
                'note' => $validated['note'] ?? null,
            ]
        ]);

        return redirect()->route('checkout.shipping');
    }

    public function shipping()
    {
        if (!session()->has('checkout_contact')) {
            return redirect()->route('checkout.contact');
        }

        $cart = $this->getOrCreateCart()->load('items.product.images');

        $categories = [
            ['slug' => 'stone', 'name' => 'Stone fruits'],
            ['slug' => 'exotic', 'name' => 'Exotic fruits'],
            ['slug' => 'citrus', 'name' => 'Citrus fruits'],
            ['slug' => 'pome', 'name' => 'Pome fruits'],
            ['slug' => 'boxes', 'name' => 'Boxes'],
        ];

        return view('checkout.shipping', compact('cart', 'categories'));
    }

    public function submit(Request $request)
    {
        if (!session()->has('checkout_contact')) {
            return redirect()->route('checkout.contact');
        }

        $validated = $request->validate([
            'delivery_method' => ['required', 'in:standard,express,pickup'],
            'payment_method' => ['required', 'in:cash,card'],
        ]);

        $contactData = session('checkout_contact');

        $cart = $this->getOrCreateCart()->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        try {
        DB::transaction(function () use ($cart, $validated, $contactData) {
            $totalPrice = 0;

            foreach ($cart->items as $item) {
                $product = Product::lockForUpdate()->find($item->product_id);

                if (!$product) {
                    throw new \Exception('Product not found.');
                }

                if ($product->stock < $item->quantity) {
                    throw new \Exception("Only {$product->stock} item(s) left in stock for {$product->name}.");
                }

                $totalPrice += $item->unit_price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'session_id' => Auth::check() ? null : session()->getId(),
                'customer_name' => $contactData['full_name'],
                'email' => $contactData['email'],
                'phone' => $contactData['phone'],
                'address' => $contactData['street'],
                'city' => $contactData['city'],
                'zip_code' => $contactData['postal_code'],
                'delivery_method' => $validated['delivery_method'],
                'payment_method' => $validated['payment_method'],
                'status' => 'new',
                'total_price' => $totalPrice,
            ]);

            foreach ($cart->items as $item) {
                $product = Product::lockForUpdate()->find($item->product_id);

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ]);

                $product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
        });

        session()->forget(['checkout_contact', 'checkout_shipping']);

        return redirect()->route('checkout.success');
    } catch (\Exception $e) {
        return redirect()->route('cart')->with('error', $e->getMessage());
    }
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

    public function success()
    {
        return view('checkout.success');
    }

    private function attachSessionCartToUser(User $user, string $sessionId): void
    {
        $sessionCart = Cart::with('items')
            ->where('session_id', $sessionId)
            ->first();

        if (!$sessionCart) {
            return;
        }

        $userCart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        foreach ($sessionCart->items as $sessionItem) {
            $existingItem = $userCart->items()
                ->where('product_id', $sessionItem->product_id)
                ->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $sessionItem->quantity);
            } else {
                $userCart->items()->create([
                    'product_id' => $sessionItem->product_id,
                    'quantity' => $sessionItem->quantity,
                    'unit_price' => $sessionItem->unit_price,
                ]);
            }
        }

        $sessionCart->items()->delete();
        $sessionCart->delete();
    }
}
