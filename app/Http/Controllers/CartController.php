<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
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
        
        return view('cart.index', compact('products', 'total'));
    }
    
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        
        $product = Product::findOrFail($productId);
        
        // Check stock
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        
        foreach ($request->quantity as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->stock >= $quantity) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }
    
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
    
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}