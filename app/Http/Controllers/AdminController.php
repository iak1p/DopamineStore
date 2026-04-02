<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showCreate()
    {
        return view('admin.create');
    }

    public function showEdit($slug)
    {
        $products = Product::with('images')->get();

        $product = $products->firstWhere('slug', $slug);

        if (!$product) {
            abort(404);
        }

        return view('admin.edit', compact('product'));
    }

    public function edit(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'unit' => ['required', 'string'],
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'url' => '/product/' . Str::slug($validated['name']),
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'stock' => $validated['quantity'],
            'category' => $validated['category'],
            'unit' => $validated['unit'],
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'alt_text' => $product->name,
            ]);
        }

        return redirect()->route('product', $product->slug);
    }

    public function delete(Request $request, $slug)
    {
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $product->delete();

        return redirect()->route('shop');
    }

    public function deleteImg(Request $request, $id)
    {
        $image = ProductImage::findOrFail($id);

        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return back();
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'category' => ['string'],
            'unit' => ['string'],
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'url' => '/product/' . Str::slug($validated['name']),
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'stock' => $validated['quantity'],
            'category' => $validated['category'],
            'unit' => $validated['unit'],
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'alt_text' => $product->name,
            ]);
        }

        // dd($path);

        return redirect()->route('shop');
    }
}
