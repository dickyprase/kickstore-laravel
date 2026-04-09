@extends('layouts.modern')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <a href="{{ route('orders.index') }}" class="text-amber-600 hover:text-amber-800">
                            &larr; Kembali ke Pesanan Saya
                        </a>
                    </div>
                    
                    <div class="flex flex-col md:flex-row justify-between mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">Detail Pesanan</h1>
                        
                        <div>
                            <span class="px-4 py-2 rounded-full {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ $order->status === 'pending' ? 'Menunggu Konfirmasi' : 'Dikonfirmasi' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-medium text-gray-900 mb-2">Informasi Pesanan</h2>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="text-sm text-gray-600">Invoice:</div>
                                <div class="text-sm font-medium">{{ $order->invoice_code }}</div>
                                
                                <div class="text-sm text-gray-600">Tanggal:</div>
                                <div class="text-sm font-medium">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                
                                <div class="text-sm text-gray-600">Status:</div>
                                <div class="text-sm font-medium">
                                @if($order->status === 'pending')
                                        Menunggu Konfirmasi
                                @elseif($order->status === 'confirmed')
                                        Dikonfirmasi
                                @else
                                        Ditolak
                                @endif
                                </div>
                                
                                <div class="text-sm text-gray-600">Total:</div>
                                <div class="text-sm font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h2 class="text-lg font-medium text-gray-900 mb-2">Informasi Pembeli</h2>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="text-sm text-gray-600">Nama:</div>
                                <div class="text-sm font-medium">{{ $order->user->name }}</div>
                                
                                <div class="text-sm text-gray-600">Email:</div>
                                <div class="text-sm font-medium">{{ $order->user->email }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Produk yang Dibeli</h2>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Produk
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-12 w-12">
                                                        <img class="h-12 w-12 object-cover rounded" src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $item->product->category->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $item->qty }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6 text-right">
                            <p class="text-sm text-gray-600">Total: <span class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                    
                    @if($order->status === 'pending')
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="bg-yellow-50 rounded-md p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Menunggu Pembayaran</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Silakan lakukan pembayaran dan konfirmasi melalui WhatsApp untuk menyelesaikan pesanan ini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ $whatsAppUrl }}" target="_blank" 
                                class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 px-4 rounded-md transition">
                                <i class="fab fa-whatsapp mr-2"></i> Konfirmasi via WhatsApp
                            </a>
                        </div>
                    @elseif($order->status === 'confirmed')
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="bg-green-50 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-green-800">Pembayaran Dikonfirmasi</h3>
                                        <div class="mt-2 text-sm text-green-700">
                                            <p>Terima kasih! Pembayaran Anda telah dikonfirmasi dan pesanan Anda sedang diproses.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="bg-red-50 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-times-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Pesanan Ditolak</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>Mohon maaf, pesanan Anda telah ditolak. Silakan hubungi customer service kami untuk informasi lebih lanjut.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection