<x-admin-layout>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0 font-weight-bold text-primary">Products Table</h3>
                    <form class="d-flex align-items-center sort">
                        <!-- Sort By Dropdown -->
                        <div class="mr-3">
                            <label for="sort" class="text-sm text-gray-700">Sort By:</label>
                            <select name="s" class="form-control form-control-sm">
                                <option value="id" {{ request('s') == 'id' ? 'selected' : '' }}>Id</option>
                                <option value="name" {{ request('s') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="price" {{ request('s') == 'price' ? 'selected' : '' }}>Price</option>
                                <option value="stock" {{ request('s') == 'stock' ? 'selected' : '' }}>Stock</option>
                                <option value="total" {{ request('s') == 'total' ? 'selected' : '' }}>Total Amount</option>
                                <option value="created_at" {{ request('s') == 'created_at' ? 'selected' : '' }}>Created At</option>
                                <option value="updated_at" {{ request('s') == 'updated_at' ? 'selected' : '' }}>Updated At</option>
                            </select>
                        </div>

                        <!-- Direction Dropdown -->
                        <div class="mr-3">
                            <label for="direction" class="text-sm text-gray-700">Direction:</label>
                            <select name="direction" class="form-control form-control-sm">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <!-- Display Table Only If Products Exist -->
                @if (isset($products) && $products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th class="d-none d-sm-table-cell">Total Amount</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th class="d-none d-sm-table-cell">Total Amount</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($products as $key => $value)
                                    <tr onclick="window.location.href = '{{route('admin.products.show', $value)}}'">
                                        <td><a href="{{route('admin.products.show', $value)}}" >{{ $value->id }}</a></td>
                                        <td><a href="{{route('admin.products.show', $value)}}" >{{ $value->name }}</a></td>
                                        <td><a href="{{route('admin.products.show', $value)}}" >{{ $value->stock }}</a></td>
                                        <td><a href="{{route('admin.products.show', $value)}}" >${{ $value->price }}</a></td>
                                        <td class="d-none d-md-table-cell"><a href="{{route('admin.products.show', $value)}}" >{{ $value->created_at->format('M d, Y') }}</a></td>
                                        <td class="d-none d-sm-table-cell"><a href="{{route('admin.products.show', $value)}}" >${{ $value->price * $value->stock }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Show No Products Message -->
                    <div class="alert alert-warning text-center" style="min-height: 300px; font-size: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <strong>No products available</strong>
                        
                        <!-- Button Below the Message -->
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-3">Add Product</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
