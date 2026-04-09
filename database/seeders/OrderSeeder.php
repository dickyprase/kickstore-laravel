<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure we have a non-admin user
        $user = User::where('role', 'user')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'user@example.com',
                'phone' => '08123456789',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]);
        }
        
        // Sample orders
        $orders = [
            [
                'status' => 'pending',
                'created_at' => now()->subDays(2),
            ],
            [
                'status' => 'confirmed',
                'created_at' => now()->subDays(5),
            ],
            [
                'status' => 'rejected',
                'created_at' => now()->subDays(7),
            ],
        ];
        
        foreach ($orders as $orderData) {
            // Create order
            $order = Order::create([
                'invoice_code' => 'INV-' . strtoupper(Str::random(10)),
                'user_id' => $user->id,
                'status' => $orderData['status'],
                'total_price' => 0, // Will update after adding items
                'created_at' => $orderData['created_at'],
                'updated_at' => $orderData['created_at'],
            ]);
            
            // Get random products for order items
            $products = Product::inRandomOrder()->take(rand(1, 3))->get();
            $totalPrice = 0;
            
            // Create order items
            foreach ($products as $product) {
                $qty = rand(1, 3);
                $price = $product->price;
                $subtotal = $price * $qty;
                $totalPrice += $subtotal;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'price' => $price,
                    'created_at' => $orderData['created_at'],
                    'updated_at' => $orderData['created_at'],
                ]);
            }
            
            // Update order total
            $order->update(['total_price' => $totalPrice]);
        }
    }
}