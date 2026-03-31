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
                'category' => 'stone',
                'image_path' => 'products/peach.png',
                'alt_text' => 'Peach',
                'url' => '/product/peach',
                'slug' => 'peach'
            ],
            [
                'name' => 'Apricot',
                'price' => 4.20,
                'description' => 'Fresh apricot',
                'stock' => 20,
                'category' => 'stone',
                'image_path' => 'products/apricot.png',
                'alt_text' => 'Apricot',
                'url' => '/product/apricot',
                'slug' => 'apricot'
            ],
            [
                'name' => 'Orange',
                'price' => 2.80,
                'description' => 'Fresh orange',
                'stock' => 20,
                'category' => 'citrus',
                'image_path' => 'products/orange.png',
                'alt_text' => 'Orange',
                'url' => '/product/orange',
                'slug' => 'orange'
            ],
            [
                'name' => 'Lemon',
                'price' => 2.40,
                'description' => 'Fresh lemon',
                'stock' => 0,
                'category' => 'citrus',
                'image_path' => 'products/lemon.png',
                'alt_text' => 'Lemon',
                'url' => '/product/lemon',
                'slug' => 'lemon'
            ],
            [
                'name' => 'Apple',
                'price' => 2.50,
                'description' => 'Fresh apple',
                'stock' => 20,
                'category' => 'pome',
                'image_path' => 'products/apple.png',
                'alt_text' => 'Apple',
                'url' => '/product/apple',
                'slug' => 'apple'
            ],
            [
                'name' => 'Pear',
                'price' => 3.10,
                'description' => 'Fresh pear',
                'stock' => 20,
                'category' => 'pome',
                'image_path' => 'products/pear.png',
                'alt_text' => 'Pear',
                'url' => '/product/pear',
                'slug' => 'pear'
            ],
            [
                'name' => 'Mango',
                'price' => 2.90,
                'description' => 'Fresh mango',
                'stock' => 20,
                'category' => 'exotic',
                'image_path' => 'products/mango.png',
                'alt_text' => 'Mango',
                'url' => '/product/mango',
                'slug' => 'mango'
            ],
            [
                'name' => 'Dragon Fruit',
                'price' => 5.50,
                'description' => 'Fresh dragon fruit',
                'stock' => 20,
                'category' => 'exotic',
                'image_path' => 'products/dragon-fruit.png',
                'alt_text' => 'Dragon Fruit',
                'url' => '/product/dragon-fruit',
                'slug' => 'dragon-fruit'
            ],
            [
                'name' => 'Fruit Box Classic',
                'price' => 14.90,
                'description' => 'Mixed fruits box',
                'stock' => 20,
                'category' => 'boxes',
                'image_path' => 'products/fruit-box.png',
                'alt_text' => 'Fruit Box Classic',
                'url' => '/product/fruit-box-classic',
                'slug' => 'fruit-box-classic'
            ],
            [
                'name' => 'Fruit Box Premium',
                'price' => 24.90,
                'description' => 'Premium mixed fruits box',
                'stock' => 20,
                'category' => 'boxes',
                'image_path' => 'products/fruit-box-premium.png',
                'alt_text' => 'Fruit Box Premium',
                'url' => '/product/fruit-box-premium',
                'slug' => 'fruit-box-premium'
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'stock' => $item['stock'],
                'category' => $item['category'],
                'url' => $item['url'],
                'slug' => $item['slug'],
            ]);

            $product->images()->create([
                'image_path' => $item['image_path'],
                'alt_text' => $item['alt_text'],
            ]);
        }
    }
}
