<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KickStore') }} - @yield('title', 'Premium Footwear')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }
        
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradientMove 15s ease infinite;
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .scale-up {
            transition: transform 0.3s ease;
        }
        
        .scale-up:hover {
            transform: scale(1.03);
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .staggered-item {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-50 min-h-screen flex flex-col">
    <div id="app" class="flex-grow flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm" x-data="{ open: false }">
            <!-- Top Nav Bar with Logo and Search -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold text-blue-600">{{ substr(config('app.name', 'KickStore'), 0, 4) }}<span class="text-gray-800">{{ substr(config('app.name', 'KickStore'), 4) }}</span></span>
                        </a>
                    </div>
                    
                    <!-- Desktop Search -->
                    <div class="hidden sm:flex items-center flex-1 max-w-md mx-8">
                        <form action="{{ route('products.index') }}" method="GET" class="w-full">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" placeholder="Search for shoes..." 
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-full 
                                    text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-1 
                                    focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-300">
                            </div>
                        </form>
                    </div>
                    
                    <!-- Desktop Nav Links -->
                    <div class="hidden sm:flex sm:items-center sm:space-x-4">
                        <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Home</a>
                        <a href="{{ route('products.index') }}" class="px-3 py-2 text-sm font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Products</a>
                        
                        <!-- Cart Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="px-3 py-2 flex items-center text-sm font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">
                                <i class="fas fa-shopping-bag mr-1"></i>
                                <span>Cart</span>
                                <span class="ml-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full">
                                    {{ count(session('cart', [])) }}
                                </span>
                            </button>
                            
                            <div x-show="open" 
                                @click.away="open = false" 
                                x-transition:enter="transition ease-out duration-200" 
                                x-transition:enter-start="opacity-0 transform scale-95" 
                                x-transition:enter-end="opacity-100 transform scale-100" 
                                x-transition:leave="transition ease-in duration-150" 
                                x-transition:leave-start="opacity-100 transform scale-100" 
                                x-transition:leave-end="opacity-0 transform scale-95" 
                                class="absolute right-0 w-80 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                                style="display: none;">
                                <div class="p-3">
                                    <div class="flex items-center justify-between border-b pb-3">
                                        <h3 class="text-sm font-medium text-gray-900">Shopping Cart</h3>
                                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-600 rounded-full">
                                            {{ count(session('cart', [])) }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-3 max-h-60 overflow-y-auto">
                                        @php
                                            $cart = session('cart', []);
                                            $cartTotal = 0;
                                        @endphp
                                        
                                        @forelse($cart as $id => $details)
                                            @php
                                                $product = \App\Models\Product::find($id);
                                                if ($product) {
                                                    $cartTotal += $product->price * $details['quantity'];
                                                }
                                            @endphp
                                            
                                            @if($product)
                                                <div class="flex items-center py-2 border-b">
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded">
                                                    <div class="ml-3 flex-1">
                                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $details['quantity'] }} × Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                    </div>
                                                    <a href="{{ route('cart.remove', $id) }}" class="text-xs text-red-500 hover:text-red-700">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @empty
                                            <div class="py-3 text-center text-gray-500">
                                                Your cart is empty
                                            </div>
                                        @endforelse
                                    </div>
                                    
                                    @if(count($cart) > 0)
                                        <div class="mt-3 pt-3 border-t">
                                            <div class="flex justify-between text-sm font-medium text-gray-900">
                                                <p>Total:</p>
                                                <p>Rp {{ number_format($cartTotal, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="mt-3">
                                                <a href="{{ route('cart.index') }}" class="flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                                                    View Cart
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Menu -->
                        @auth
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="px-3 py-2 flex items-center text-sm font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">
                                    <span class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-2">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-1 text-xs"></i>
                                </button>
                                
                                <div x-show="open" 
                                    @click.away="open = false" 
                                    x-transition:enter="transition ease-out duration-200" 
                                    x-transition:enter-start="opacity-0 transform scale-95" 
                                    x-transition:enter-end="opacity-100 transform scale-100" 
                                    x-transition:leave="transition ease-in duration-150" 
                                    x-transition:leave-start="opacity-100 transform scale-100" 
                                    x-transition:leave-end="opacity-0 transform scale-95" 
                                    class="absolute right-0 w-48 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                                    style="display: none;">
                                    <div class="py-1">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Profile
                                        </a>
                                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            My Orders
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Sign out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                    Sign in
                                </a>
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors duration-300">
                                    Register
                                </a>
                            </div>
                        @endauth
                    </div>
                    
                    <!-- Mobile menu button-->
                    <div class="flex items-center sm:hidden">
                        <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon when menu is open -->
                            <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu, show/hide based on menu state. -->
            <div x-show="open" class="sm:hidden" id="mobile-menu" style="display: none;">
                <div class="px-4 pt-2 pb-3 space-y-1">
                    <!-- Mobile Search -->
                    <div class="pt-2 pb-3">
                        <form action="{{ route('products.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Search for shoes..." 
                                class="block w-full pl-3 pr-3 py-2 border border-gray-200 rounded-md 
                                text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-1 
                                focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </form>
                    </div>
                    
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                        Products
                    </a>
                    <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                        Cart ({{ count(session('cart', [])) }})
                    </a>
                    
                    @auth
                        <div class="border-t border-gray-200 pt-4 pb-3">
                            <div class="px-3">
                                <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            <div class="mt-3 space-y-1">
                                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                                    Profile
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                                    My Orders
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="border-t border-gray-200 pt-4 pb-3">
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-800 hover:text-blue-600 hover:bg-gray-50 rounded-md">
                                Sign in
                            </a>
                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium bg-blue-600 text-white hover:bg-blue-700 rounded-md mt-2">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
        
        <!-- Category Navigation (Optional, only on specific pages) -->
        @hasSection('categories')
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto">
                    <div class="overflow-x-auto hide-scrollbar">
                        <div class="flex py-3 px-4 space-x-6">
                            @yield('categories')
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 fade-in">
                <div class="bg-green-50 border-l-4 border-green-400 p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                                <span class="sr-only">Dismiss</span>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 fade-in">
                <div class="bg-red-50 border-l-4 border-red-400 p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                                <span class="sr-only">Dismiss</span>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Breadcrumbs (Optional, can be shown on specific pages) -->
        @hasSection('breadcrumbs')
            <div class="bg-gray-50 py-3 border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-sm text-gray-600">
                        @yield('breadcrumbs')
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    
                </div>
                
                <div class="border-t border-gray-800 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'KickStore') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Back to top button -->
    <button id="backToTopBtn" class="fixed bottom-5 right-5 bg-blue-600 text-white rounded-full p-3 shadow-lg opacity-0 transition-opacity duration-300 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });
            
            // Staggered Animation
            const staggeredItems = document.querySelectorAll('.staggered-item');
            if (staggeredItems.length > 0) {
                staggeredItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 100 * index);
                });
            }
            
            // Back to top button
            const backToTopBtn = document.getElementById('backToTopBtn');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.add('opacity-100');
                } else {
                    backToTopBtn.classList.remove('opacity-100');
                }
            });
            
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>