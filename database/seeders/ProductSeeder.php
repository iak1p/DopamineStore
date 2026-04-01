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
                'description' => 'Sweet and juicy peaches with a delicate aroma and velvety skin. Perfect for fresh snacking, desserts or summer smoothies.',
                'stock' => 20,
                'category' => 'stone',
                // 'image_path' => 'products/peach.png',
                // 'alt_text' => 'Peach',
                'url' => '/product/peach',
                'slug' => 'peach',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/peach.png',
                        'alt_text' => 'Peach'
                    ],
                    [
                        'image_path' => 'products/peach-2.png',
                        'alt_text' => 'Peach 2'
                    ],
                ]
            ],
            [
                'name' => 'Apricot',
                'price' => 4.20,
                'description' => 'Tender apricots with a naturally sweet taste and a hint of tartness. Ideal for jams, baking or a healthy snack.',
                'stock' => 20,
                'category' => 'stone',
                // 'image_path' => 'products/apricot.png',
                // 'alt_text' => 'Apricot',
                'url' => '/product/apricot',
                'slug' => 'apricot',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/apricot.png',
                        'alt_text' => 'Apricot'
                    ],
                ]
            ],
            [
                'name' => 'Orange',
                'price' => 2.80,
                'description' => 'Fresh and juicy oranges packed with vitamin C. Great for refreshing juices, desserts or everyday consumption.',
                'stock' => 20,
                'category' => 'citrus',
                // 'image_path' => 'products/orange.png',
                // 'alt_text' => 'Orange',
                'url' => '/product/orange',
                'slug' => 'orange',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/orange.png',
                        'alt_text' => 'Orange'
                    ],
                ]
            ],
            [
                'name' => 'Lemon',
                'price' => 2.40,
                'description' => 'Bright and zesty lemons with an intense citrus flavor. Perfect for drinks, cooking or adding freshness to any dish.',
                'stock' => 0,
                'category' => 'citrus',
                // 'image_path' => 'products/lemon.png',
                // 'alt_text' => 'Lemon',
                'url' => '/product/lemon',
                'slug' => 'lemon',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/lemon.png',
                        'alt_text' => 'Lemon'
                    ],
                ]
            ],
            [
                'name' => 'Apple',
                'price' => 2.50,
                'description' => 'Crisp and refreshing apples with a balanced sweet and slightly tart taste. A classic healthy snack for any time of day.',
                'stock' => 20,
                'category' => 'pome',
                // 'image_path' => 'products/apple.png',
                // 'alt_text' => 'Apple',
                'url' => '/product/apple',
                'slug' => 'apple',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/apple.png',
                        'alt_text' => 'Apple'
                    ],
                ]
            ],
            [
                'name' => 'Pear',
                'price' => 3.10,
                'description' => 'Soft and juicy pears with a smooth texture and delicate sweetness. Perfect for desserts or fresh consumption.',
                'stock' => 20,
                'category' => 'pome',
                // 'image_path' => 'products/pear.png',
                // 'alt_text' => 'Pear',
                'url' => '/product/pear',
                'slug' => 'pear',
                'unit' => 'kg',
                'images' => [
                    [
                        'image_path' => 'products/pear.png',
                        'alt_text' => 'Pear'
                    ],
                ]
            ],
            [
                'name' => 'Mango',
                'price' => 2.90,
                'description' => 'Exotic mangoes with a rich tropical flavor and buttery texture. Ideal for smoothies, desserts or fresh enjoyment.',
                'stock' => 20,
                'category' => 'exotic',
                // 'image_path' => 'products/mango.png',
                // 'alt_text' => 'Mango',
                'url' => '/product/mango',
                'slug' => 'mango',
                'unit' => 'pcs',
                'images' => [
                    [
                        'image_path' => 'products/mango.png',
                        'alt_text' => 'Mango'
                    ],
                ]
            ],
            [
                'name' => 'Dragon Fruit',
                'price' => 5.50,
                'description' => 'Vibrant dragon fruit with a mildly sweet taste and refreshing texture. A perfect exotic addition to your diet.',
                'stock' => 20,
                'category' => 'exotic',
                // 'image_path' => 'products/dragon-fruit.png',
                // 'alt_text' => 'Dragon Fruit',
                'url' => '/product/dragon-fruit',
                'slug' => 'dragon-fruit',
                'unit' => 'pcs',
                'images' => [
                    [
                        'image_path' => 'products/dragon-fruit.png',
                        'alt_text' => 'Dragon Fruit'
                    ],
                ]
            ],
            [
                'name' => 'Fruit Box Classic',
                'price' => 14.90,
                'description' => 'A carefully selected mix of seasonal fruits. Perfect for everyday consumption or sharing with family.',
                'stock' => 20,
                'category' => 'boxes',
                // 'image_path' => 'products/fruit-box.png',
                // 'alt_text' => 'Fruit Box Classic',
                'url' => '/product/fruit-box-classic',
                'slug' => 'fruit-box-classic',
                'unit' => 'pcs',
                'images' => [
                    [
                        'image_path' => 'products/fruit-box.png',
                        'alt_text' => 'Fruit Box Classic'
                    ],
                ]
            ],
            [
                'name' => 'Fruit Box Premium',
                'price' => 24.90,
                'description' => 'A premium selection of high-quality fruits, including exotic varieties. Ideal as a gift or for a luxurious treat.',
                'stock' => 20,
                'category' => 'boxes',
                // 'image_path' => 'products/fruit-box-premium.png',
                // 'alt_text' => 'Fruit Box Premium',
                'url' => '/product/fruit-box-premium',
                'slug' => 'fruit-box-premium',
                'unit' => 'pcs',
                'images' => [
                    [
                        'image_path' => 'products/fruit-box-premium.png',
                        'alt_text' => 'Fruit Box Premium'
                    ],
                ]
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
                'unit' => $item['unit'],
            ]);

            // $product->images()->create([
            //     'image_path' => $item['image_path'],
            //     'alt_text' => $item['alt_text'],
            // ]);
            foreach ($item['images'] as $image) {
                $product->images()->create([
                    'image_path' => $image['image_path'],
                    'alt_text' => $image['alt_text'],
                ]);
            }
        }
    }
}
