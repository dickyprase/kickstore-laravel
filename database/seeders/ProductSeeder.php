<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1, // Running Shoes
                'name' => 'KickRun Pro 2023',
                'price' => 1200000,
                'stock' => 20,
                'description' => 'High-performance running shoes with advanced cushioning technology for maximum comfort during long runs.'
            ],
            [
                'category_id' => 1, // Running Shoes
                'name' => 'SpeedForce Runner',
                'price' => 950000,
                'stock' => 15,
                'description' => 'Lightweight running shoes designed for speed. Perfect for sprints and training sessions.'
            ],
            [
                'category_id' => 2, // Casual Sneakers
                'name' => 'UrbanWalk Classic',
                'price' => 800000,
                'stock' => 25,
                'description' => 'Stylish and comfortable casual sneakers for everyday wear. Perfect match with any outfit.'
            ],
            [
                'category_id' => 2, // Casual Sneakers
                'name' => 'StreetStyle X1',
                'price' => 875000,
                'stock' => 18,
                'description' => 'Modern streetwear sneakers with bold design and premium materials. Make a statement wherever you go.'
            ],
            [
                'category_id' => 3, // Basketball Shoes
                'name' => 'HoopMaster Elite',
                'price' => 1350000,
                'stock' => 12,
                'description' => 'Professional basketball shoes with superior ankle support and grip. Designed for performance on the court.'
            ],
            [
                'category_id' => 3, // Basketball Shoes
                'name' => 'JumpForce Pro',
                'price' => 1450000,
                'stock' => 10,
                'description' => 'High-top basketball shoes with enhanced cushioning for better jumps and landings.'
            ],
            [
                'category_id' => 4, // Formal Shoes
                'name' => 'ExecutivePro Oxford',
                'price' => 1100000,
                'stock' => 15,
                'description' => 'Classic Oxford shoes made with genuine leather. Perfect for formal occasions and business meetings.'
            ],
            [
                'category_id' => 4, // Formal Shoes
                'name' => 'Elegance Loafers',
                'price' => 950000,
                'stock' => 20,
                'description' => 'Comfortable loafers with sleek design. Ideal for semi-formal events and office wear.'
            ],
            [
                'category_id' => 5, // Sandals & Flip Flops
                'name' => 'ComfortWalk Sandals',
                'price' => 450000,
                'stock' => 30,
                'description' => 'Durable and comfortable sandals for beach days and casual outings.'
            ],
            [
                'category_id' => 5, // Sandals & Flip Flops
                'name' => 'SummerFlex Flip Flops',
                'price' => 350000,
                'stock' => 35,
                'description' => 'Lightweight and waterproof flip flops. Essential for your summer adventures.'
            ],
        ];

        foreach ($products as $product) {
            // Gunakan placeholder image
            $product['image'] = 'products/placeholder.jpg';
            Product::create($product);
        }
    }
}