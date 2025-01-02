@php
    $rating = $product->rating;
    $full_stars = floor($rating);
    $decimal_star = ($rating - $full_stars) * 100; 
@endphp

<x-app-layout>
    <div class="container mx-auto my-12 px-4 mt-[5rem]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Product Image Section -->
            <div class="mb-8 md:mt-4 md:mb-0">
                <!-- Single product image -->
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Product Details Section -->
            <div>
                <h2 class="text-3xl font-semibold text-gray-900 mb-3">{{ $product->name }}</h2>
                <p class="text-lg text-gray-600 mb-2">Category: <span class="font-medium text-gray-800">{{ $product->category->name }}</span></p>
                <p class="text-2xl text-blue-600 mb-5">${{ number_format($product->price, 2) }}</p>

                <div class="my-4">
                    <strong class="text-lg text-gray-800">Description</strong>
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>

                <!-- Product Rating -->
                <div class="my-4">
                    <strong class="text-lg text-gray-800">Rating:</strong>
                    <div class="flex items-center space-x-1 mt-2">
                        @for ($i = 0; $i < $full_stars; $i++)
                            <svg class="w-6 h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z"/>
                            </svg>
                        @endfor
                        @if ($decimal_star > 0)
                            <svg class="w-6 h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 {{$decimal_star}}% 0 0)"/>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Add to Cart Section -->
                <div class="my-5">
                    <form action="{{ route('dashboard.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product" value="{{ $product }}">
                        <div class="flex items-center space-x-4 mb-4">
                            <label for="quantity" class="text-lg font-medium text-gray-800">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{$product->stock}}" value="1" class="w-24 p-2 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                        <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white text-lg rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
