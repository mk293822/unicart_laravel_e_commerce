@php
    $rating = $product->rating;
    $full_stars = floor($rating);
    $decimal_star = ($rating - $full_stars) * 100; 
@endphp

<x-admin-layout>
    <div class="container my-5">
        <div class="row">
            <!-- Product Image Section -->
            <div class="col-md-6 mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
            </div>

            <!-- Product Details Section -->
            <div class="col-md-6">
                <h2 class="h3 font-weight-bold text-primary mb-3">{{ $product->name }}</h2>
                <p class="text-muted">Category: <strong>{{ $product->category->name }}</strong></p>
                <p class="h4 text-success">${{ number_format($product->price, 2) }}</p>

                <div class="my-3">
                    <strong class="text-muted">Description:</strong>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="my-3">
                    <strong class="text-muted">Stock:</strong>
                    <p>{{ $product->stock }}</p>
                </div>

                <!-- Product Rating -->
                <div class="my-3">
                    <strong class="text-muted">Rating:</strong>
                    <div class="d-flex">
                        @for ($i = 0; $i < $full_stars; $i++)
                            <svg class="bi bi-star-fill text-warning" style="width: 2rem; height: 2rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z"/>
                            </svg>
                        @endfor
                        @if ($decimal_star > 0)
                            <svg class="bi bi-star-fill text-warning" style="width: 2rem; height: 2rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>
                                <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 {{$decimal_star}}% 0 0)"/>
                            </svg>
                        @endif
                        @if ($full_stars == 0)
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="bi bi-star-fill text-warning" style="width: 2rem; height: 2rem;" style="width: 2rem; height: 2rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>
                                    <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 100% 0 0)"/>
                                </svg>
                            @endfor
                        @else
                            @if ($decimal_star > 0)
                                @for ($i = 0; $i < 4 - $full_stars; $i++)
                                    <svg class="bi bi-star-fill text-warning" style="width: 2rem; height: 2rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 100% 0 0)"/>
                                    </svg>
                                @endfor
                            @else
                                @for ($i = 0; $i < 5 - $full_stars; $i++)
                                    <svg class="bi bi-star-fill text-warning" style="width: 2rem; height: 2rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="none" stroke="currentColor"/>
                                        <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03L12 17.27z" fill="currentColor" stroke="none" clip-path="inset(0 100% 0 0)"/>
                                    </svg>
                                @endfor
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Admin Actions: Update and Delete -->
                <div class="my-4">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-lg mr-3">
                        Update Product
                    </a>

                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
