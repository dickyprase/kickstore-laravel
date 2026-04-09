<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KickStore') }} - @yield('title', 'Sepatu Keren dan Trendy')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #7fad39;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #688e30;
        }
        
        /* Hover Effects */
        .hover-grow {
            transition: all 0.3s;
        }
        
        .hover-grow:hover {
            transform: scale(1.03);
        }
        
        /* Custom Styles for Categories */
        .category-card {
            transition: all 0.3s;
            overflow: hidden;
        }
        
        .category-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .category-card:hover img {
            transform: scale(1.05);
        }
        
        /* Custom Button Styles */
        .btn-primary {
            background-color: #7fad39;
            border-color: #7fad39;
            color: white;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #688e30;
            border-color: #688e30;
        }
        
        /* Top Bar */
        .top-bar {
            background-color: #f5f5f5;
        }
        
        /* Header */
        .main-header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        /* Navigation */
        .main-nav {
            background-color: #7fad39;
        }
        
        /* Footer */
        .main-footer {
            background-color: #F3F6FA;
        }
        
        .footer-dark {
            background-color: #1c1c1c;
            color: white;
        }
    </style>
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <!-- Top Bar -->
    <div class="top-bar py-2 border-b text-gray-600 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="mailto:info@kickstore.com" class="text-sm hover:text-green-600 transition">
                        <i class="fas fa-envelope mr-1"></i> info@kickstore.com
                    </a>
                    <span class="text-gray-400">|</span>
                    <a href="tel:+6281234567890" class="text-sm hover:text-green-600 transition">
                        <i class="fas fa-phone mr-1"></i> +62 812-3456-7890
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover:text-green-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-sm hover:text-green-600 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-sm hover:text-green-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-sm hover:text-green-600 transition">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header -->
    <header class="main-header py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Logo -->
                <div class="mb-4 md:mb-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-green-600">KICK<span class="text-gray-800">STORE</span></span>
                    </a>
                </div>
                
                <!-- Search -->
                <div class="w-full md:w-1/3 mb-4 md:mb-0">
                    <form action="{{ route('products.index') }}" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari produk..." 
                            class="w-full py-2 pl-4 pr-10 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-green-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Cart and User -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('cart.index') }}" class="flex items-center text-gray-700 hover:text-green-600 transition relative">
                        <i class="fas fa-shopping-bag text-xl"></i>
                        <span class="ml-1">Keranjang</span>
                        <span class="absolute -top-2 -right-2 bg-green-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                    
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-green-600 transition">
                                <i class="fas fa-user-circle text-xl mr-1"></i>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            
                            <div x-cloak x-show="open" @click.away="open = false" 
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profil
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Pesanan Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 transition">Masuk</a>
                            <span class="text-gray-400">|</span>
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-600 transition">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="main-nav py-3 text-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Categories Dropdown -->
                <div class="relative group hidden md:block" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 bg-green-700 px-4 py-2 rounded-md">
                        <i class="fas fa-bars"></i>
                        <span>Kategori</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    
                    <div x-cloak x-show="open" @click.away="open = false" 
                        class="absolute left-0 mt-1 w-60 bg-white rounded-md shadow-lg py-1 z-50">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        
                        @foreach($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Main Menu -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-200 transition">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-white hover:text-gray-200 transition">Produk</a>
                    <a href="#" class="text-white hover:text-gray-200 transition">Tentang Kami</a>
                    <a href="#" class="text-white hover:text-gray-200 transition">Kontak</a>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <div class="md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" class="text-white">
                        <i x-show="!open" class="fas fa-bars text-xl"></i>
                        <i x-show="open" class="fas fa-times text-xl"></i>
                    </button>
                    
                    <!-- Mobile Menu -->
                    <div x-cloak x-show="open" 
                        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                        <div class="bg-white rounded-lg w-11/12 max-w-md p-4">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Menu</h3>
                                <button @click="open = false" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            
                            <div class="divide-y">
                                <a href="{{ route('home') }}" class="block py-3 text-gray-800 hover:text-green-600">Beranda</a>
                                <a href="{{ route('products.index') }}" class="block py-3 text-gray-800 hover:text-green-600">Produk</a>
                                
                                <!-- Mobile Categories -->
                                <div x-data="{ openCategories: false }" class="py-3">
                                    <button @click="openCategories = !openCategories" class="flex justify-between items-center w-full text-left text-gray-800 hover:text-green-600">
                                        <span>Kategori</span>
                                        <i x-show="!openCategories" class="fas fa-chevron-down"></i>
                                        <i x-show="openCategories" class="fas fa-chevron-up"></i>
                                    </button>
                                    
                                    <div x-show="openCategories" class="mt-2 pl-4 space-y-2">
                                        @foreach($categories as $category)
                                            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block py-1 text-gray-600 hover:text-green-600">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <a href="#" class="block py-3 text-gray-800 hover:text-green-600">Tentang Kami</a>
                                <a href="#" class="block py-3 text-gray-800 hover:text-green-600">Kontak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="main-footer pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">KICKSTORE</h3>
                    <p class="text-gray-600 mb-4">Sepatu keren dan trendy untuk gaya Anda sehari-hari. Kualitas terbaik dengan harga terjangkau.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-700 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-700 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-700 transition">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan Pelanggan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-green-600 transition">Cara Pemesanan</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-green-600 transition">Metode Pembayaran</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-green-600 transition">Pengiriman</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-green-600 transition">Pengembalian</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-green-600 transition">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kategori</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-gray-600 hover:text-green-600 transition">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-green-600"></i>
                            <span class="text-gray-600">Jl. Sepatu Indah No. 123, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-green-600"></i>
                            <span class="text-gray-600">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-green-600"></i>
                            <span class="text-gray-600">info@kickstore.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-2 text-green-600"></i>
                            <span class="text-gray-600">08.00 - 20.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="footer-dark py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="mb-2 md:mb-0">&copy; {{ date('Y') }} KickStore. All rights reserved.</p>
                <div class="flex space-x-4">
                    <img src="https://raw.githubusercontent.com/tailwindtoolbox/Rainblur-Landing-Page/main/banner/visa.png" alt="Visa" class="h-8">
                    <img src="https://raw.githubusercontent.com/tailwindtoolbox/Rainblur-Landing-Page/main/banner/mastercard.png" alt="Mastercard" class="h-8">
                    <img src="https://raw.githubusercontent.com/tailwindtoolbox/Rainblur-Landing-Page/main/banner/paypal.png" alt="PayPal" class="h-8">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>