@extends('layouts.modern')

@section('title', 'Products')

@section('breadcrumbs')
    <div class="flex items-center text-sm">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Home</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <span class="text-gray-800">Products</span>
    </div>
@endsection

@section('content')
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mobile Filter Button -->
            <div class="md:hidden flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-900">Products</h1>
                <button type="button" x-data="" @click="$dispatch('open-filter')" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    <i class="fas fa-filter mr-2"></i> Filters
                </button>
            </div>
            
            <div class="flex flex-col md:flex-row">
                <!-- Sidebar Filters (Desktop) -->
                <div class="hidden md:block md:w-1/4 lg:w-1/5 md:pr-8" data-aos="fade-right">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Latest Products</h2>
                    <div class="space-y-4">
                        @php
                            $latestProducts = App\Models\Product::latest()->limit(3)->get();
                        @endphp
                        
                        @foreach($latestProducts as $latestProduct)
                            <a href="{{ route('products.show', $latestProduct) }}" class="group flex items-center">
                                <div class="flex-shrink-0 h-14 w-14 overflow-hidden rounded-md">
                                    <img src="{{ asset('storage/' . $latestProduct->image) }}" alt="{{ $latestProduct->name }}" 
                                         class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $latestProduct->name }}</p>
                                    <p class="text-sm font-medium text-blue-600">Rp {{ number_format($latestProduct->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Mobile Filter Sidebar -->
                <div x-data="{ open: false }" 
                     @open-filter.window="open = true" 
                     x-cloak 
                     class="relative z-10" 
                     aria-labelledby="slide-over-title" 
                     role="dialog" 
                     aria-modal="true">
                    <!-- Background backdrop -->
                    <div x-show="open" 
                         x-transition:enter="transition-opacity ease-linear duration-300" 
                         x-transition:enter-start="opacity-0" 
                         x-transition:enter-end="opacity-100" 
                         x-transition:leave="transition-opacity ease-linear duration-300" 
                         x-transition:leave-start="opacity-100" 
                         x-transition:leave-end="opacity-0" 
                         class="fixed inset-0 bg-black bg-opacity-25 pointer-events-none"></div>
                    
                    <!-- Sliding panel -->
                    <div class="fixed inset-0 overflow-hidden pointer-events-none">
                        <div class="absolute inset-0 overflow-hidden">
                            <div class="pointer-events-none fixed inset-y-0 left-0 flex max-w-full">
                                <div x-show="open" 
                                     x-transition:enter="transform transition ease-in-out duration-500" 
                                     x-transition:enter-start="-translate-x-full" 
                                     x-transition:enter-end="translate-x-0" 
                                     x-transition:leave="transform transition ease-in-out duration-500" 
                                     x-transition:leave-start="translate-x-0" 
                                     x-transition:leave-end="-translate-x-full" 
                                     @click.away="open = false" 
                                     class="pointer-events-auto w-screen max-w-md">
                                    <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl">
                                        <div class="p-4 flex items-center justify-between">
                                            <h2 class="text-lg font-semibold text-gray-900" id="slide-over-title">Latest Products</h2>
                                            <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Close panel</span>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <div class="space-y-4">
                                                @php
                                                    $latestProducts = App\Models\Product::latest()->limit(3)->get();
                                                @endphp
                                                
                                                @foreach($latestProducts as $latestProduct)
                                                    <a href="{{ route('products.show', $latestProduct) }}" class="group flex items-center">
                                                        <div class="flex-shrink-0 h-14 w-14 overflow-hidden rounded-md">
                                                            <img src="{{ asset('storage/' . $latestProduct->image) }}" alt="{{ $latestProduct->name }}" 
                                                                 class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                                                        </div>
                                                        <div class="ml-4">
                                                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $latestProduct->name }}</p>
                                                            <p class="text-sm font-medium text-blue-600">Rp {{ number_format($latestProduct->price, 0, ',', '.') }}</p>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Grid -->
                <div class="md:w-3/4 lg:w-4/5" data-aos="fade-left">
                    <!-- Top sorting bar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 bg-white p-4 rounded-lg shadow-sm">
                        <div class="mb-4 sm:mb-0">
                            <h2 class="text-lg font-semibold text-gray-900 hidden md:block">Products</h2>
                            <p class="text-sm text-gray-500">Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>
                        </div>
                        
                        <div class="flex items-center">
                            <label for="sort" class="text-sm text-gray-700 mr-2">Sort by:</label>
                            <form action="{{ route('products.index') }}" method="GET" id="sort-form" class="inline-block">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                
                                <select name="sort" id="sort" onchange="document.getElementById('sort-form').submit()" 
                                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Products -->
                    @if($products->isEmpty())
                        <div class="bg-white p-8 rounded-lg shadow-sm text-center" data-aos="fade-up">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" alt="No products found" class="w-24 h-24 mx-auto mb-4 opacity-50">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                            <p class="text-gray-600 mb-4">Try adjusting your search or filter criteria</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                                Reset Filters
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $index => $product)
                                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 staggered-item" 
                                     data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                                    <a href="{{ route('products.show', $product) }}" class="block relative group">
                                        <div class="aspect-w-1 aspect-h-1 w-full">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                                 class="h-full w-full object-cover object-center transform transition-transform duration-300 group-hover:scale-105">
                                        </div>
                                        
                                        @if($product->stock > 0)
                                            <div class="absolute top-2 right-2 bg-green-500 text-white text-xs rounded-full px-2 py-1 font-semibold">
                                                In Stock
                                            </div>
                                        @else
                                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1 font-semibold">
                                                Out of Stock
                                            </div>
                                        @endif
                                        
                                        <!-- Quick view button (appears on hover) -->
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-20">
                                            <span class="bg-white text-gray-900 px-4 py-2 rounded-full text-sm font-medium shadow-sm">
                                                Quick View
                                            </span>
                                        </div>
                                    </a>
                                    
                                    <div class="p-4">
                                        <a href="{{ route('products.show', $product) }}" class="block">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="text-xs text-gray-500">{{ $product->category->name }}</span>
                                                <div class="flex text-yellow-400 text-xs">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                            </div>
                                            <h3 class="text-base font-medium text-gray-900 hover:text-blue-600 transition-colors duration-300 line-clamp-1">{{ $product->name }}</h3>
                                            <div class="mt-2 mb-4">
                                                <span class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                        </a>
                                        
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-400 cursor-not-allowed">
                                                <i class="fas fa-ban mr-2"></i> Out of Stock
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- Recently Viewed (Optional) -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">You May Also Like</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
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
@endsection