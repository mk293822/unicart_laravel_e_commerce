<x-admin-layout>
    <div class="container-fluid p-0 mx-4 mr-4">
        <div class="row justify-content-center bg-light py-5">
            <!-- Main Content Wrapper with 100% width -->
            <div class="col-12">
                
                <!-- User Information Section -->
                <div class="card shadow-lg rounded-lg bg-white p-5 mb-3">
                    <h2 class="font-weight-bold text-primary text-center mb-4">{{ $user->name }}</h2>
                    <div class="user-details mb-4">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="font-weight-bold text-muted">Email:</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p><strong>{{ $user->email }}</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="font-weight-bold text-muted">ID:</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p><strong>{{ $user->id }}</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="font-weight-bold text-muted">Created At:</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p><strong>{{ $user->created_at->format('M d, Y') }}</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="font-weight-bold text-muted">Updated At:</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <p><strong>{{ $user->updated_at->format('M d, Y') }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- Orders Section with Table -->
                <div class="card shadow-lg rounded-lg bg-white p-5 mb-3">
                    <h4 class="font-weight-bold text-dark mb-4">Orders:</h4>
                    
                    <!-- Table for Orders -->
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Total Products</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($user->order as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->ordered_products->sum('quantity') }}</td>
                                    <td>
                                        <!-- Button to show more details or expand the order information -->
                                        <button class="btn btn-info btn-sm" data-toggle="collapse" data-target="#orderDetails{{ $order->id }}">View Products</button>
                                    </td>
                                </tr>
                                <!-- Order Products Details (collapsed) -->
                                <tr id="orderDetails{{ $order->id }}" class="collapse">
                                    <td colspan="4">
                                        <!-- Product Details Table -->
                                        <h4 class="text-center">Products of Order {{$order->id}}</h4>
                                        <table class="table table-bordered table-striped mt-3">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Product ID</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->ordered_products as $ordered_product)
                                                    <tr>
                                                        <td>{{ $ordered_product->products->name }}</td>
                                                        <td>{{ $ordered_product->products->id }}</td>
                                                        <td>{{ $ordered_product->quantity }}</td>
                                                        <td>{{ number_format($ordered_product->products->price, 2) }}</td>
                                                        <td>{{ number_format($ordered_product->quantity * $ordered_product->products->price, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Admin Actions -->
                <div class="card shadow-lg rounded-lg bg-white p-5">
                    <h4 class="font-weight-bold text-dark mb-4 text-center">Admin Actions</h4>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-lg mx-3 px-4 py-2 rounded-pill shadow-md">
                            Update User
                        </a>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg mx-3 px-4 py-2 rounded-pill shadow-md">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
