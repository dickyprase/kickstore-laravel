@extends('layouts.modern')

@section('title', 'Order Confirmation')

@section('content')
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden" data-aos="fade-up">
                <!-- Order Confirmation Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-12 text-center text-white">
                    <div class="w-20 h-20 mx-auto bg-white rounded-full flex items-center justify-center text-blue-600 mb-6 shadow-md">
                        <i class="fas fa-check-circle text-4xl"></i>
                    </div>
                    
                    <h1 class="text-2xl font-bold mb-2">Thank You for Your Order!</h1>
                    <p class="text-blue-100">Your order has been received and is being processed</p>
                    
                    <div class="mt-6 inline-block bg-white text-blue-600 font-bold px-4 py-2 rounded-md">
                        Order #{{ $order->invoice_code }}
                    </div>
                </div>
                
                <!-- Order Details -->
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h2>
                        
                        <div class="bg-blue-50 rounded-md p-4 mb-6 border border-blue-200 flex items-start">
                            <div class="flex-shrink-0 text-blue-500 mt-1">
                                <i class="fas fa-info-circle text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-base font-medium text-blue-800">Complete Your Payment</h3>
                                <p class="mt-2 text-sm text-blue-700">
                                    To complete your order, please make a payment to the bank account below and confirm via WhatsApp.
                                    Your order will be processed after the payment is verified.
                                </p>
                                
                                <div class="mt-4">
                                    <a href="{{ $whatsAppUrl }}" target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 transition-colors duration-300">
                                        <i class="fab fa-whatsapp mr-2"></i> Confirm Payment via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 rounded-md p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Order Information</h3>
                                <dl class="space-y-1">
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Order Number:</dt>
                                        <dd class="font-medium text-gray-900">{{ $order->invoice_code }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Date:</dt>
                                        <dd class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y, h:i A') }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Status:</dt>
                                        <dd class="font-medium">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Awaiting Payment
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Total:</dt>
                                        <dd class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                                    </div>
                                </dl>
                            </div>
                            
                            <div class="bg-gray-50 rounded-md p-4">
                                <h3 class="text-sm font-medium text-gray-900 mb-3">Customer Information</h3>
                                <dl class="space-y-1">
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Name:</dt>
                                        <dd class="font-medium text-gray-900">{{ $order->user->name }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Email:</dt>
                                        <dd class="font-medium text-gray-900">{{ $order->user->email }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Phone:</dt>
                                        <dd class="font-medium text-gray-900">{{ $order->user->phone ?? 'Not provided' }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Items Ordered</h3>
                        
                        <div class="border rounded-lg overflow-hidden mb-6">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-md object-cover" 
                                                             src="{{ asset('storage/' . $item->product->image) }}" 
                                                             alt="{{ $item->product->name }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                                {{ $item->qty }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                                                Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-500">
                                            Subtotal
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-500">
                                            Shipping
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                            Rp 0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                            Total
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-blue-600">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                            <i class="fas fa-list-ul mr-1"></i> View All Orders
                        </a>
                        
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                            Continue Shopping <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection