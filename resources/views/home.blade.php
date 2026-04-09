@extends('layouts.modern')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Hero Background with Animated Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 animate-gradient"></div>
        
        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div data-aos="fade-right">
                    <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">
                        Step Into <span class="text-yellow-300">Comfort</span> and <span class="text-yellow-300">Style</span>
                    </h1>
                    <p class="mt-4 text-xl text-blue-100 max-w-lg">
                        Discover our premium collection of footwear designed for every occasion, lifestyle, and personality.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 transition-colors duration-300 shadow-lg z-10">
                            <i class="fas fa-shopping-bag mr-2"></i> Shop Now
                        </a>
                        <a href="#categories" class="inline-flex items-center justify-center px-6 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-blue-700 transition-colors duration-300 z-10">
                            <i class="fas fa-th-large mr-2"></i> Browse Categories
                        </a>
                    </div>
                </div>
                
                <div class="hidden md:block" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1025&q=80" 
                         alt="Shoes Collection" class="w-full rounded-lg shadow-2xl transform rotate-2 scale-up">
                </div>
            </div>
        </div>
        
        <!-- Wave SVG -->
        <div class="absolute bottom-0 left-0 right-0 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,128L48,144C96,160,192,192,288,186.7C384,181,480,139,576,144C672,149,768,203,864,208C960,213,1056,171,1152,154.7C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900">Why Choose us?</h2>
                <p class="mt-4 text-lg text-gray-600">We're committed to providing you with the best shopping experience</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-shipping-fast text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">We ship your order within 1-3 business days to anywhere in Indonesia.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality Guarantee</h3>
                    <p class="text-gray-600">All our products come with a 30-day quality guarantee for your peace of mind.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <div class="inline-flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-headset text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our customer service team is ready to assist you anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <section id="categories" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900">Shop by Categories</h2>
                <p class="mt-4 text-lg text-gray-600">Find the perfect shoes for every occasion</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="relative overflow-hidden rounded-lg shadow-sm h-64 staggered-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60 transition-opacity duration-300 hover:opacity-40"></div>
                        
                        <!-- Category Image (using placeholder for now) -->
                        <div class="absolute inset-0">
                            <div class="h-full w-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        </div>
                        
                        <!-- Category Content -->
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h3 class="text-xl font-bold text-white mb-1">{{ $category->name }}</h3>
                            <p class="text-blue-200 mb-4">Explore our collection</p>
                            <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                               class="inline-flex items-center text-sm font-medium text-white hover:text-blue-300 transition-colors duration-300">
                                <span>Shop Now</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Featured Products -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900">Featured Products</h2>
                <p class="mt-4 text-lg text-gray-600">Handpicked selection of our most popular products</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $index => $product)
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 staggered-item" 
                         data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <a href="{{ route('products.show', $product) }}" class="block relative group">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover object-center transform transition-transform duration-300 group-hover:scale-105">
                            
                            @if($product->stock > 0)
                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs rounded-full px-2 py-1 font-semibold">
                                    In Stock
                                </div>
                            @else
                                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1 font-semibold">
                                    Out of Stock
                                </div>
                            @endif
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
                                <h3 class="text-lg font-medium text-gray-900 hover:text-blue-600 transition-colors duration-300">{{ $product->name }}</h3>
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
            
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                    <i class="fas fa-th-large mr-2"></i> View All Products
                </a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-900">What Our Customers Say</h2>
                <p class="mt-4 text-lg text-gray-600">Don't just take our word for it, hear from our satisfied customers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"These shoes are incredibly comfortable and stylish. I've received so many compliments! The quality is outstanding and they fit perfectly. Will definitely be ordering more!"</p>
                    <div class="flex items-center mt-auto">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <span class="font-bold">BS</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-gray-900">Budi Santoso</h4>
                            <p class="text-xs text-gray-500">Jakarta</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The customer service was exceptional and the shipping was faster than expected. The shoes are even better in person than they appeared online. Very satisfied with my purchase!"</p>
                    <div class="flex items-center mt-auto">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <span class="font-bold">SN</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-gray-900">Siti Nurhaliza</h4>
                            <p class="text-xs text-gray-500">Bandung</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm transition-all duration-300 hover:shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"I've been shopping for shoes online for years, and this site offers the best value for money I've seen. Great quality, affordable prices, and excellent service. Highly recommend!"</p>
                    <div class="flex items-center mt-auto">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <span class="font-bold">RH</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-gray-900">Rudi Hermawan</h4>
                            <p class="text-xs text-gray-500">Surabaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Newsletter Section -->
    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-white">Stay Updated</h2>
                <p class="mt-4 text-lg text-blue-100">Subscribe to our newsletter for exclusive deals and updates on new arrivals</p>
                
                <form class="mt-8 flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0">
                    <input type="email" placeholder="Your email address" 
                           class="w-full sm:w-auto px-5 py-3 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-white text-blue-600 font-semibold rounded-r-md hover:bg-blue-50 transition-colors duration-300">
                        Subscribe
                    </button>
                </form>
                
                <p class="mt-4 text-sm text-blue-200">We respect your privacy. Unsubscribe at any time.</p>
            </div>
        </div>
    </section>
@endsection