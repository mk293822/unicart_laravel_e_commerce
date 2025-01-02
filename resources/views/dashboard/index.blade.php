
<x-app-layout>
    <div class="py-12 mt-[4rem] px-4">
        <!-- Hero Section -->
        <div class="relative w-full h-[64vh] bg-gradient-to-r rounded-lg from-blue-600 via-indigo-600 to-purple-600 text-white">
            <div class="absolute inset-0 flex flex-col justify-center items-center space-y-4 text-center">
                <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight">
                    Welcome to Our Shop!
                </h1>
                <p class="text-lg sm:text-xl opacity-80">
                    Discover your next favorite product.
                </p>
                <a href="#products" class="bg-white text-black px-6 py-3 rounded-full font-semibold text-md hover:bg-gray-200 transition ease-in-out duration-300">
                    Explore Now
                </a>
            </div>
        </div>

        <div id="products" class=""></div>

        <!-- Products Section -->
        <div class="max-w-7xl mx-auto mt-8 " >
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" >
                <!-- Dynamic Product Cards -->
                @foreach ($products as $product)
                    @php
                        $rating = $product->rating;
                        $full_stars = floor($rating);
                        $decimal_star = ($rating - $full_stars) * 100; 

                    @endphp

                    <div class="flex flex-col bg-white rounded-lg shadow-lg hover:shadow-xl transform transition duration-300 ease-in-out hover:scale-105 border border-gray-200 overflow-hidden">
                        
                        <!-- Product Image with Hover Effect -->
                        <div class="relative group">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full text-center h-48 object-cover group-hover:opacity-80 transition-opacity duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50 group-hover:opacity-60 transition-opacity duration-300"></div>
                            <div class="absolute inset-0 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{route("dashboard.show", $product)}}" class="bg-white text-black px-4 py-2 rounded-full shadow-lg font-semibold text-md">Quick View</a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 flex flex-col justify-between flex-1 space-y-2">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $product->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $product->description ?? 'No description available' }}</p>
                            </div>
                            <p class="text-sm text-black/80 font-bold">{{ $product->stock }} stocks left</p>
                            
                            <!-- Product Rating -->
                            <div class="flex space-x-1 text-yellow-400">
                                @for ($i = 0; $i < $full_stars; $i++)
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z"/>
                                    </svg>
                                @endfor
                                @if ($decimal_star > 0)
                                    <svg class="w-4 h-4 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">

                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>

                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 {{$decimal_star}}% 0 0)"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- Price -->
                            <p class="text-xl font-bold text-gray-900">${{ $product->price }}</p>

                            <!-- Add to Cart Button -->
                            <form class="add-to-cart-form flex justify-center items-center mt-auto" data-product-id="{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md font-semibold text-sm uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Newsletter Signup Section -->
        <div class="bg-gray-800 text-white py-12 mt-12">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                <p class="text-lg opacity-80 mb-6">Sign up for our newsletter to receive the latest updates and offers.</p>
                <form class="flex justify-center items-center space-x-4">
                    <input type="email" class="px-6 py-3 w-80 rounded-full border border-gray-300" placeholder="Enter your email">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-full font-semibold text-lg hover:bg-blue-500 transition duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
