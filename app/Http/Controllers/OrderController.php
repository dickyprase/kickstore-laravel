<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->get();
        
        return view('orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        $whatsAppService = new WhatsAppService();
        $whatsAppUrl = $whatsAppService->generateCheckoutUrl($order);
        
        return view('orders.show', compact('order', 'whatsAppUrl'));
    }
}