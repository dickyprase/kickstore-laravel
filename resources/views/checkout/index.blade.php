@extends('layouts.modern')

@section('title', 'Checkout')

@section('breadcrumbs')
    <div class="flex items-center text-sm">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Home</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Shopping Cart</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <span class="text-gray-800">Checkout</span>
    </div>
@endsection

@section('content')
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">Checkout</h1>
            
            <div class="mb-8" data-aos="fade-up">
                <div class="flex justify-between items-center">
                    <h2 class="sr-only">Checkout steps</h2>
                    
                    <div class="flex w-full max-w-3xl mx-auto">
                        <div class="flex-1 relative">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="text-sm font-medium text-blue-600 mt-2">Shopping Cart</div>
                            </div>
                            <div class="absolute top-4 h-0.5 w-full bg-blue-600"></div>
                        </div>
                        
                        <div class="flex-1 relative">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="text-sm font-medium text-blue-600 mt-2">Checkout</div>
                            </div>
                            <div class="absolute top-4 left-0 h-0.5 w-1/2 bg-blue-600"></div>
                            <div class="absolute top-4 right-0 h-0.5 w-1/2 bg-gray-300"></div>
                        </div>
                        
                        <div class="flex-1 relative">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="text-sm font-medium text-gray-500 mt-2">Confirmation</div>
                            </div>
                            <div class="absolute top-4 left-0 h-0.5 w-1/2 bg-gray-300"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Checkout Details -->
                <div class="lg:col-span-8" data-aos="fade-right">
                    <!-- Customer Information -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold text-gray-900">Customer Information</h2>
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                        <i class="fas fa-edit"></i> Edit Profile
                                    </a>
                                @endauth
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <p class="text-gray-900">{{ auth()->user()->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-gray-900">{{ auth()->user()->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <p class="text-gray-900">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h2>
                            
                            <div class="bg-blue-50 p-4 rounded-md mb-6 border border-blue-200">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fab fa-whatsapp text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-base font-medium text-blue-800">WhatsApp Payment Confirmation</h3>
                                        <p class="mt-2 text-sm text-blue-700">
                                            After completing your order, you'll be redirected to WhatsApp to confirm your payment details.
                                            Please transfer the payment to one of our bank accounts below and send the payment confirmation through WhatsApp.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="text-md font-medium text-gray-900 mb-3">Available Bank Accounts</h3>
                            
                            <div class="space-y-3 mb-4">
                            @foreach($banks as $index => $bank)
                                <div class="border rounded-md p-4 {{ $index === 0 ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}" data-radio="bank_{{ $index }}">
                                    <label class="flex items-start">
                                        <input type="radio" name="bank_id" value="{{ $bank->id }}" class="mt-1 form-radio text-blue-600" {{ $index === 0 ? 'checked' : '' }} onclick="changeColor(this)">
                                        <div class="ml-3">
                                            <div class="font-medium">{{ $bank->bank_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $bank->account_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $bank->account_number }}</div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                            </div>
                            
                            <div class="text-sm text-gray-600">
                                <p><i class="fas fa-info-circle text-blue-600 mr-1"></i> Please make sure to transfer the exact amount including the decimal digits to help us identify your payment.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-4" data-aos="fade-left">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden sticky top-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                            
                            <div class="space-y-4 mb-4">
                                @foreach($products as $id => $details)
                                    <div class="flex border-b border-gray-200 pb-4">
                                        <div class="flex-shrink-0 w-16 h-16">
                                            <img src="{{ asset('storage/' . $details['product']->image) }}" alt="{{ $details['product']->name }}" 
                                                 class="w-full h-full object-cover rounded-md">
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <h3 class="text-sm font-medium text-gray-900 line-clamp-1">{{ $details['product']->name }}</h3>
                                            <p class="text-xs text-gray-500">{{ $details['quantity'] }} × Rp {{ number_format($details['product']->price, 0, ',', '.') }}</p>
                                            <p class="text-sm font-medium text-gray-900 mt-1">Rp {{ number_format($details['product']->price * $details['quantity'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="space-y-2 pt-4 border-t border-gray-200">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">Rp 0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tax</span>
                                    <span class="font-medium">Rp 0</span>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 mt-4 pt-4 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-gray-900">Total</span>
                                    <span class="text-lg font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md shadow-md transition-colors duration-300 flex items-center justify-center">
                                    <i class="fas fa-check-circle mr-2"></i> Place Order
                                </button>
                            </form>
                            
                            <div class="mt-4 text-center">
                                <a href="{{ route('cart.index') }}" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to Cart
                                </a>
                            </div>
                        </div>
                        
                        <!-- Secure Checkout Notice -->
                        <div class="bg-gray-50 px-6 py-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-lock text-green-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-900">Secure Checkout</span>
                            </div>
                            <p class="text-xs text-gray-600">
                                Your personal information is encrypted and secure. We never store your payment details.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    function changeColor(input) {
        // Menghilangkan class aktif dari semua div
        document.querySelectorAll('.border').forEach(div => {
            div.classList.remove('border-blue-500', 'bg-blue-50');
            div.classList.add('border-gray-200');
        });

        // Menambahkan class aktif pada div yang terkait dengan radio yang dipilih
        const parentDiv = input.closest('div');
        parentDiv.classList.remove('border-gray-200');
        parentDiv.classList.add('border-blue-500', 'bg-blue-50');
    }
</script>