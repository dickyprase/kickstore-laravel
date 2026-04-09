@extends('layouts.modern')

@section('title', 'Shopping Cart')

@section('breadcrumbs')
    <div class="flex items-center text-sm">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Home</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <span class="text-gray-800">Shopping Cart</span>
    </div>
@endsection

@section('content')
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">Shopping Cart</h1>
            
            @if(empty($products))
                <div class="bg-white rounded-lg shadow-sm p-8 text-center" data-aos="fade-up">
                    <div class="w-24 h-24 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-gray-300">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-medium text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-600 mb-8">Looks like you haven't added any products to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                        <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
                    </a>
                </div>
            @else
                <div x-data="{ activeStep: 1 }" class="mb-6" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <h2 class="sr-only">Checkout steps</h2>
                        
                        <div class="relative flex w-full max-w-3xl justify-between items-center px-4 py-8 mx-auto">
    <!-- Garis latar belakang -->
    <div class="absolute top-4 left-4 right-4 h-0.5 bg-blue-600 z-0"></div>

    <!-- Step 1 -->
    <div class="step flex flex-col items-center z-10">
        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="text-sm font-medium text-blue-600 mt-2">Shopping Cart</div>
    </div>

    <!-- Step 2 -->
    <div class="step flex flex-col items-center z-10">
        <div class="w-8 h-8 rounded-full border-2 border-gray-300 text-gray-400 flex items-center justify-center bg-white">
            <i class="fas fa-credit-card"></i>
        </div>
        <div class="text-sm font-medium text-gray-500 mt-2">Checkout</div>
    </div>

    <!-- Step 3 -->
    <div class="step flex flex-col items-center z-10">
        <div class="w-8 h-8 rounded-full border-2 border-gray-300 text-gray-400 flex items-center justify-center bg-white">
            <i class="fas fa-check"></i>
        </div>
        <div class="text-sm font-medium text-gray-500 mt-2">Confirmation</div>
    </div>
</div>

                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2" data-aos="fade-right">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Items in Your Cart</h2>
                                
                                <div class="space-y-6">
                                    @foreach($products as $id => $details)
                                        <div class="flex flex-col sm:flex-row border-b border-gray-200 pb-6 staggered-item">
                                            <div class="flex-shrink-0 sm:w-24 sm:h-24 mb-4 sm:mb-0">
                                                <img src="{{ asset('storage/' . $details['product']->image) }}" alt="{{ $details['product']->name }}" 
                                                    class="w-full h-full object-cover rounded-md">
                                            </div>
                                            
                                            <div class="flex-1 sm:ml-6">
                                                <div class="flex flex-wrap justify-between">
                                                    <div>
                                                        <h3 class="text-base font-medium text-gray-900">
                                                            <a href="{{ route('products.show', $details['product']) }}" class="hover:text-blue-600 transition-colors duration-300">
                                                                {{ $details['product']->name }}
                                                            </a>
                                                        </h3>
                                                        <p class="mt-1 text-sm text-gray-500">{{ $details['product']->category->name }}</p>
                                                    </div>
                                                    
                                                    <div class="text-base font-medium text-gray-900">
                                                        Rp {{ number_format($details['product']->price, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-4 flex flex-wrap items-center justify-between">
                                                    <div class="sm:w-32 w-20">
                                                        <label for="quantity-{{ $id }}" class="sr-only">Quantity</label>
                                                        <div class="flex items-center border border-gray-300 rounded">
                                                            <button type="button" class="p-2 text-gray-600 hover:text-blue-600 focus:outline-none"
                                                                    onclick="decrementCartQuantity('quantity-{{ $id }}', {{ $id }}, {{ $details['product']->price }})">
                                                                <i class="fas fa-minus text-xs"></i>
                                                            </button>
                                                            <input type="number" id="quantity-{{ $id }}" name="quantity[{{ $id }}]" 
                                                                data-price="{{ $details['product']->price }}"
                                                                value="{{ $details['quantity'] }}" min="1" max="{{ $details['product']->stock }}" 
                                                                class="w-full border-0 text-center focus:ring-0 text-sm"
                                                                onchange="updateCartSubtotal({{ $id }}, {{ $details['product']->price }})">
                                                            <button type="button" class="p-2 text-gray-600 hover:text-blue-600 focus:outline-none"
                                                                    onclick="incrementCartQuantity('quantity-{{ $id }}', {{ $id }}, {{ $details['product']->stock }}, {{ $details['product']->price }})">
                                                                <i class="fas fa-plus text-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="flex items-center space-x-4 mt-3 sm:mt-0">
                                                        <span class="text-base font-medium text-gray-900" id="subtotal-{{ $id }}">
                                                            Rp {{ number_format($details['product']->price * $details['quantity'], 0, ',', '.') }}
                                                        </span>
                                                        
                                                        <a href="{{ route('cart.remove', $id) }}" class="text-sm text-red-600 hover:text-red-800 transition-colors duration-300">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span class="ml-1">Remove</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-6 flex flex-wrap justify-between items-center">
                                <div class="flex flex-wrap space-y-2 sm:space-y-0 sm:space-x-4 mb-4 sm:mb-0">
                                    <a href="{{ route('products.index') }}" class="flex items-center justify-center text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Continue Shopping
                                    </a>
                                    
                                    <a href="{{ route('cart.clear') }}" class="flex items-center justify-center text-sm text-red-600 hover:text-red-800 transition-colors duration-300">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Clear Cart
                                    </a>
                                </div>
                                
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    <div id="hidden-quantities">
                                        @foreach($products as $id => $details)
                                            <input type="hidden" name="quantity[{{ $id }}]" id="hidden-quantity-{{ $id }}" value="{{ $details['quantity'] }}">
                                        @endforeach
                                    </div>
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                                        <i class="fas fa-sync-alt mr-2"></i>
                                        Update Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cart Summary -->
                    <div class="lg:col-span-1" data-aos="fade-left">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden sticky top-8">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                                
                                <div class="space-y-4 mb-6">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Subtotal</span>
                                        <span class="font-medium" id="cart-subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Shipping</span>
                                        <span class="font-medium">Rp 0</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Tax</span>
                                        <span class="font-medium">Rp 0</span>
                                    </div>
                                    
                                    <div class="border-t border-gray-200 pt-4 flex justify-between">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span class="text-lg font-bold text-blue-600" id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Proceed to Checkout -->
                                @auth
                                    <a href="{{ route('checkout.index') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md shadow-md transition-colors duration-300 mb-4">
                                        Proceed to Checkout
                                    </a>
                                @else
                                    <div class="text-center mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Please login to continue with checkout</p>
                                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-md shadow-md transition-colors duration-300">
                                            Login to Checkout
                                        </a>
                                    </div>
                                @endauth
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    
    @if(!empty($products))
        <!-- You May Also Like -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">You May Also Like</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @php
                        $recommendedProducts = App\Models\Product::inRandomOrder()->limit(5)->get();
                    @endphp
                    
                    @foreach($recommendedProducts as $index => $product)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300" 
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <a href="{{ route('products.show', $product) }}" class="block relative">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                     class="w-full h-40 object-cover object-center">
                            </a>
                            
                            <div class="p-3">
                                <a href="{{ route('products.show', $product) }}" class="block">
                                    <h3 class="text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors duration-300 line-clamp-1">{{ $product->name }}</h3>
                                    <div class="mt-1">
                                        <span class="text-sm font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
<script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount).replace('IDR', 'Rp');
    }
    
    function decrementCartQuantity(inputId, productId, price) {
        const input = document.getElementById(inputId);
        const hiddenInput = document.getElementById('hidden-quantity-' + productId);
        const value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
            hiddenInput.value = value - 1;
            updateCartSubtotal(productId, price);
        }
    }
    
    function incrementCartQuantity(inputId, productId, maxStock, price) {
        const input = document.getElementById(inputId);
        const hiddenInput = document.getElementById('hidden-quantity-' + productId);
        const value = parseInt(input.value);
        if (value < maxStock) {
            input.value = value + 1;
            hiddenInput.value = value + 1;
            updateCartSubtotal(productId, price);
        }
    }
    
    function updateCartSubtotal(productId, price) {
        const quantityInput = document.getElementById('quantity-' + productId);
        const hiddenInput = document.getElementById('hidden-quantity-' + productId);
        const quantity = parseInt(quantityInput.value);
        const subtotal = price * quantity;
        
        hiddenInput.value = quantity;
        document.getElementById('subtotal-' + productId).textContent = formatCurrency(subtotal);
        
        // Recalculate total
        let total = 0;
        document.querySelectorAll('[id^="quantity-"]').forEach(input => {
            if (input.id.startsWith('quantity-')) {
                const id = input.id.replace('quantity-', '');
                const price = parseFloat(input.dataset.price);
                const qty = parseInt(input.value);
                total += price * qty;
            }
        });
        
        document.getElementById('cart-subtotal').textContent = formatCurrency(total);
        document.getElementById('cart-total').textContent = formatCurrency(total);
    }
</script>
@endpush