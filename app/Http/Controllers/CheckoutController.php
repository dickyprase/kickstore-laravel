<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Bank;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }
        
        $products = [];
        $total = 0;
        
        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $products[$id] = [
                    'product' => $product,
                    'quantity' => $details['quantity']
                ];
                $total += $product->price * $details['quantity'];
            }
        }

        $banks = Bank::all();
        
        return view('checkout.index', compact('products', 'total', 'banks'));
    }
    
    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }
        
        // Calculate total
        $total = 0;
        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $total += $product->price * $details['quantity'];
            }
        }
        
        // Create order
        $order = Order::create([
            'invoice_code' => 'INV-' . strtoupper(Str::random(10)),
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'pending'
        ]);
        
        // Create order items
        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'qty' => $details['quantity'],
                    'price' => $product->price
                ]);
                
                // Update stock
                $product->update([
                    'stock' => $product->stock - $details['quantity']
                ]);
            }
        }
        
        // Clear cart
        session()->forget('cart');
        
        // Generate WhatsApp URL for checkout confirmation
        $whatsAppService = new WhatsAppService();
        $whatsAppUrl = $whatsAppService->generateCheckoutUrl($order);
        
        return redirect()->route('checkout.success', ['order' => $order->id, 'whatsapp_url' => $whatsAppUrl]);
    }
    
    public function success(Request $request)
    {
        $order = Order::with('orderItems.product')->findOrFail($request->order);
        $whatsAppUrl = $request->whatsapp_url;
        
        return view('checkout.success', compact('order', 'whatsAppUrl'));
    }
}