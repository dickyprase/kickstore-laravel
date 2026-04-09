<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Bank;

class WhatsAppService
{
    public function generateCheckoutUrl(Order $order): string
    {
        $bank = Bank::first();
        
        $message = "Halo, saya ingin konfirmasi pesanan dengan kode invoice: {$order->invoice_code}\n\n";
        $message .= "Detail Pesanan:\n";
        
        foreach ($order->orderItems as $item) {
            $message .= "- {$item->product->name} ({$item->qty} pcs) @ Rp" . number_format($item->price, 0, ',', '.') . "\n";
        }
        
        $message .= "\nTotal: Rp" . number_format($order->total_price, 0, ',', '.') . "\n\n";
        
        if ($bank) {
            $message .= "Pembayaran dapat dilakukan ke:\n";
            $message .= "Bank: {$bank->bank_name}\n";
            $message .= "Atas Nama: {$bank->account_name}\n";
            $message .= "No. Rekening: {$bank->account_number}\n\n";
        }
        
        $message .= "Terima kasih telah berbelanja di KickStore!";
        
        // Get WhatsApp number from .env
        $whatsappNumber = env('WHATSAPP_NUMBER', '6289685259671'); // default value in case the env is not set
        
        // WhatsApp URL with encoded message
        return 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);
    }
}
