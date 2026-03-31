<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Peach',
                'price' => 3.90,
                'description' => 'Fresh peach',
                'stock' => 20,
                'category' => 'Stone',
                'image_path' => 'products/peach.png',
                'alt_text' => 'Peach',
            ],
            [
                'name' => 'Apricot',
                'price' => 4.20,
                'description' => 'Fresh apricot',
                'stock' => 20,
                'category' => 'Stone',
                'image_path' => 'products/apricot.png',
                'alt_text' => 'Apricot',
            ],
            [
                'name' => 'Orange',
                'price' => 2.80,
                'description' => 'Fresh orange',
                'stock' => 20,
                'category' => 'Citrus',
                'image_path' => 'products/orange.png',
                'alt_text' => 'Orange',
            ],
            [
                'name' => 'Lemon',
                'price' => 2.40,
                'description' => 'Fresh lemon',
                'stock' => 0,
                'category' => 'Citrus',
                'image_path' => 'products/lemon.png',
                'alt_text' => 'Lemon',
            ],
            [
                'name' => 'Apple',
                'price' => 2.50,
                'description' => 'Fresh apple',
                'stock' => 20,
                'category' => 'Pome',
                'image_path' => 'products/apple.png',
                'alt_text' => 'Apple',
            ],
            [
                'name' => 'Pear',
                'price' => 3.10,
                'description' => 'Fresh pear',
                'stock' => 20,
                'category' => 'Pome',
                'image_path' => 'products/pear.png',
                'alt_text' => 'Pear',
            ],
            [
                'name' => 'Mango',
                'price' => 2.90,
                'description' => 'Fresh mango',
                'stock' => 20,
                'category' => 'Exotic',
                'image_path' => 'products/mango.png',
                'alt_text' => 'Mango',
            ],
            [
                'name' => 'Dragon Fruit',
                'price' => 5.50,
                'description' => 'Fresh dragon fruit',
                'stock' => 20,
                'category' => 'Exotic',
                'image_path' => 'products/dragon-fruit.png',
                'alt_text' => 'Dragon Fruit',
            ],
            [
                'name' => 'Fruit Box Classic',
                'price' => 14.90,
                'description' => 'Mixed fruits box',
                'stock' => 20,
                'category' => 'Boxes',
                'image_path' => 'products/fruit-box.png',
                'alt_text' => 'Fruit Box Classic',
            ],
            [
                'name' => 'Fruit Box Premium',
                'price' => 24.90,
                'description' => 'Premium mixed fruits box',
                'stock' => 20,
                'category' => 'Boxes',
                'image_path' => 'products/fruit-box-premium.png',
                'alt_text' => 'Fruit Box Premium',
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'stock' => $item['stock'],
                'category' => $item['category'],
            ]);

            $product->images()->create([
                'image_path' => $item['image_path'],
                'alt_text' => $item['alt_text'],
            ]);
        }
    }
}