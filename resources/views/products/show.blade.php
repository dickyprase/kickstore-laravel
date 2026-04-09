@extends('layouts.modern')

@section('title', $product->name)

@section('breadcrumbs')
    <div class="flex items-center text-sm">
        <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Home</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">Products</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <a href="{{ route('products.index', ['category' => $product->category->id]) }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">{{ $product->category->name }}</a>
        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
        <span class="text-gray-800">{{ $product->name }}</span>
    </div>
@endsection

@section('content')
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
                    <!-- Product Image Section -->
                    <div class="p-6 border-b md:border-b-0 md:border-r border-gray-200" data-aos="fade-right">
                        <div class="relative aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100">
                            <!-- Main Image -->
                            <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover object-center">
                                 
                            <!-- Status Badge -->
                            @if($product->stock > 0)
                                <div class="absolute top-3 right-3 bg-green-500 text-white text-xs rounded-full px-3 py-1 font-semibold">
                                    In Stock
                                </div>
                            @else
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs rounded-full px-3 py-1 font-semibold">
                                    Out of Stock
                                </div>
                            @endif
                            
                            <!-- Image Controls -->
                            <div class="absolute right-3 bottom-3 space-y-2">
                                <button class="w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-md text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Thumbnails (just placeholders using the same image for demo) -->
                        <div class="grid grid-cols-4 gap-2 mt-4">
                            <div class="cursor-pointer rounded-md overflow-hidden border-2 border-blue-500">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover object-center">
                            </div>
                            <div class="cursor-pointer rounded-md overflow-hidden border border-gray-200 hover:border-blue-500 transition-colors duration-200">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover object-center opacity-60">
                            </div>
                            <div class="cursor-pointer rounded-md overflow-hidden border border-gray-200 hover:border-blue-500 transition-colors duration-200">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover object-center opacity-60">
                            </div>
                            <div class="cursor-pointer rounded-md overflow-hidden border border-gray-200 hover:border-blue-500 transition-colors duration-200">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-20 object-cover object-center opacity-60">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details Section -->
                    <div class="p-6" data-aos="fade-left">
                        <div class="mb-2 flex items-center">
                            <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $product->category->name }}</span>
                            
                            <!-- Rating stars -->
                            <div class="ml-auto flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ml-1 text-sm text-gray-500">(18 reviews)</span>
                            </div>
                        </div>
                        
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                        
                        <div class="mb-6">
                            <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="border-t border-gray-200 py-4 mb-6">
                            <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                        </div>
                        
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="mb-6">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                    <div class="flex items-center">
                                        <div class="inline-flex items-center border border-gray-300 rounded-md w-32">
                                            <button type="button" class="p-2 text-gray-600 hover:text-blue-600 focus:outline-none" onclick="decrementQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                                class="w-full border-0 text-center focus:ring-0">
                                            <button type="button" class="p-2 text-gray-600 hover:text-blue-600 focus:outline-none" onclick="incrementQuantity({{ $product->stock }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <span class="ml-3 text-sm text-gray-500">{{ $product->stock }} Available</span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md shadow-sm transition-colors duration-300 flex items-center justify-center">
                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                    </button>
                                    <button type="button" class="p-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-300">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button type="button" class="p-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-300">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="mb-6">
                                <div class="inline-flex items-center border border-gray-300 rounded-md bg-gray-100 w-32">
                                    <div class="p-2 text-gray-400">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                    <input type="number" value="0" disabled 
                                        class="w-full border-0 text-center bg-gray-100 text-gray-400 focus:ring-0">
                                    <div class="p-2 text-gray-400">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <span class="ml-3 text-sm text-red-500">Out of Stock</span>
                            </div>
                            
                            <div class="flex space-x-3">
                                <button disabled class="flex-1 bg-gray-400 text-white font-medium py-3 px-6 rounded-md shadow-sm flex items-center justify-center cursor-not-allowed">
                                    <i class="fas fa-ban mr-2"></i> Out of Stock
                                </button>
                                <button type="button" class="p-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-300">
                                    <i class="far fa-heart"></i>
                                </button>
                                <button type="button" class="p-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-300">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        @endif
                        
                        <!-- Additional Info -->
                        <div class="mt-8 grid grid-cols-2 gap-4 text-sm border-t border-gray-200 pt-6">
                            <div class="flex items-center">
                                <i class="fas fa-truck text-blue-600 mr-2"></i>
                                <span>Free shipping on orders over Rp 500.000</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-box text-blue-600 mr-2"></i>
                                <span>30-day easy returns</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                                <span>2 years warranty</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-blue-600 mr-2"></i>
                                <span>100% authentic products</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Tabs -->
            <div class="mt-8 bg-white rounded-lg shadow-sm overflow-hidden" x-data="{ activeTab: 'description' }" data-aos="fade-up">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button @click="activeTab = 'description'" :class="{'text-blue-600 border-b-2 font-medium border-blue-600': activeTab === 'description', 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300': activeTab !== 'description'}" class="py-4 px-6 text-sm font-medium">
                            Description
                        </button>
                        <button @click="activeTab = 'specifications'" :class="{'text-blue-600 border-b-2 font-medium border-blue-600': activeTab === 'specifications', 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300': activeTab !== 'specifications'}" class="py-4 px-6 text-sm font-medium">
                            Specifications
                        </button>
                        <button @click="activeTab = 'reviews'" :class="{'text-blue-600 border-b-2 font-medium border-blue-600': activeTab === 'reviews', 'text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300': activeTab !== 'reviews'}" class="py-4 px-6 text-sm font-medium">
                            Reviews (18)
                        </button>
                    </nav>
                </div>
                
                <div class="p-6">
                    <!-- Description Tab -->
                    <div x-show="activeTab === 'description'">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            {{ $product->description }}
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                        </p>
                    </div>
                    
                    <!-- Specifications Tab -->
                    <div x-show="activeTab === 'specifications'" x-cloak>
                        <div class="border rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50 w-1/3">Brand</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">KickStore</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Material</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">Canvas, Leather, Rubber</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Color</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">Black, White, Red, Blue</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Size Range</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">36-45 (EU)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Weight</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">300g per shoe</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Warranty</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">2 Years</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3 text-sm font-medium text-gray-900 bg-gray-50">Water Resistant</td>
                                        <td class="px-6 py-3 text-sm text-gray-700">Yes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Reviews Tab -->
                    <div x-show="activeTab === 'reviews'" x-cloak>
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="ml-2 text-sm text-gray-700">4.5 out of 5</p>
                                <p class="ml-4 text-sm text-gray-500">Based on 18 reviews</p>
                            </div>
                            
                            <!-- Rating Distribution -->
                            <div class="mb-6 space-y-2">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 w-8">5★</span>
                                    <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 70%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700">70%</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 w-8">4★</span>
                                    <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 20%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700">20%</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 w-8">3★</span>
                                    <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 5%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700">5%</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 w-8">2★</span>
                                    <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 3%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700">3%</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-700 w-8">1★</span>
                                    <div class="flex-1 h-2 mx-2 bg-gray-200 rounded-full">
                                        <div class="bg-yellow-400 h-2 rounded-full" style="width: 2%"></div>
                                    </div>
                                    <span class="text-sm text-gray-700">2%</span>
                                </div>
                            </div>
                            
                            <!-- Review List -->
                            <div class="space-y-6">
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex items-center mb-2">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                            <span class="font-bold">BS</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Budi Santoso</h4>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400 text-sm mr-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="text-xs text-gray-500">2 weeks ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">
                                        These shoes are incredibly comfortable and stylish. I've received so many compliments! The quality is outstanding and they fit perfectly. Will definitely be ordering more!
                                    </p>
                                </div>
                                
                                <div class="border-b border-gray-200 pb-6">
                                    <div class="flex items-center mb-2">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                            <span class="font-bold">SN</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Siti Nurhaliza</h4>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400 text-sm mr-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <span class="text-xs text-gray-500">1 month ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">
                                        The customer service was exceptional and the shipping was faster than expected. The shoes are even better in person than they appeared online. Very satisfied with my purchase!
                                    </p>
                                </div>
                                
                                <!-- More reviews button -->
                                <div class="text-center">
                                    <button class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                        View All 18 Reviews
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Write a Review -->
                        @auth
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Write a Review</h3>
                                <form>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                                        <div class="flex text-gray-400 text-2xl">
                                            <button type="button" class="focus:outline-none mr-1 hover:text-yellow-400 transition-colors duration-200">
                                                <i class="far fa-star"></i>
                                            </button>
                                            <button type="button" class="focus:outline-none mr-1 hover:text-yellow-400 transition-colors duration-200">
                                                <i class="far fa-star"></i>
                                            </button>
                                            <button type="button" class="focus:outline-none mr-1 hover:text-yellow-400 transition-colors duration-200">
                                                <i class="far fa-star"></i>
                                            </button>
                                            <button type="button" class="focus:outline-none mr-1 hover:text-yellow-400 transition-colors duration-200">
                                                <i class="far fa-star"></i>
                                            </button>
                                            <button type="button" class="focus:outline-none hover:text-yellow-400 transition-colors duration-200">
                                                <i class="far fa-star"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="review_title" class="block text-sm font-medium text-gray-700 mb-2">Review Title</label>
                                        <input type="text" id="review_title" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="review_body" class="block text-sm font-medium text-gray-700 mb-2">Review</label>
                                        <textarea id="review_body" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                                    </div>
                                    
                                    <div>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                                            Submit Review
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="mt-8 pt-8 border-t border-gray-200 text-center">
                                <p class="text-gray-600 mb-4">Please sign in to write a review</p>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                                    Sign In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- Related Products -->
            @if(count($relatedProducts) > 0)
                <section class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">You May Also Like</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $index => $relatedProduct)
                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300" 
                                data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <a href="{{ route('products.show', $relatedProduct) }}" class="block relative group">
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" 
                                        class="w-full h-48 object-cover object-center transform transition-transform duration-300 group-hover:scale-105">
                                        
                                    @if($relatedProduct->stock > 0)
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
                                    <a href="{{ route('products.show', $relatedProduct) }}" class="block">
                                        <h3 class="text-base font-medium text-gray-900 hover:text-blue-600 transition-colors duration-300">{{ $relatedProduct->name }}</h3>
                                        <div class="mt-1 mb-3">
                                            <span class="text-base font-bold text-blue-600">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                                        </div>
                                    </a>
                                    
                                    @if($relatedProduct->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
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
                </section>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
    
    function decrementQuantity() {
        const input = document.getElementById('quantity');
        const value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    }
    
    function incrementQuantity(max) {
        const input = document.getElementById('quantity');
        const value = parseInt(input.value);
        if (value < max) {
            input.value = value + 1;
        }
    }
</script>
@endpush