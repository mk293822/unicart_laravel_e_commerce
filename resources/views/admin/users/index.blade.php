<x-admin-layout>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="m-0 font-weight-bold text-primary">User Table</h3>
                    <form class="d-flex align-items-center user-sort">
                        <!-- Sort By Dropdown -->
                        <div class="mr-3">
                            <label for="sort" class="text-sm text-gray-700">Sort By:</label>
                            <select name="u" class="form-control form-control-sm">
                                <option value="id" {{ request('u') == 'id' ? 'selected' : '' }}>Id</option>
                                <option value="name" {{ request('u') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="email" {{ request('u') == 'email' ? 'selected' : '' }}>email</option>
                                <option value="ordered_products" {{ request('u') == 'ordered_products' ? 'selected' : '' }}>ordered_products</option>
                                <option value="created_at" {{ request('u') == 'created_at' ? 'selected' : '' }}>Created At</option>
                                <option value="updated_at" {{ request('u') == 'updated_at' ? 'selected' : '' }}>Updated At</option>
                            </select>
                        </div>

                        <!-- Direction Dropdown -->
                        <div class="mr-3">
                            <label for="directionUser" class="text-sm text-gray-700">Direction:</label>
                            <select name="directionUser" class="form-control form-control-sm">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <!-- Display Table Only If Products Exist -->
                @if (isset($users) && $users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Ordered Products</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th class="d-none d-lg-table-cell">Updated At</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Ordered Products</th>
                                    <th class="d-none d-md-table-cell">Created At</th>
                                    <th class="d-none d-lg-table-cell">Updated At</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($users as $value)
                                    @php
                                        $ordered_products = 0;
                                        foreach ($value->order as $order) {
                                            foreach ($order->ordered_products as $ordered_item) {
                                                $ordered_products += $ordered_item->quantity;
                                            }
                                        } 
                                    @endphp
                                    @if (request('u') == 'ordered_products')
                                        @if(request('q') == $ordered_products)
                                           <tr onclick="window.location.href = '{{route('admin.users.show', $value)}}'">
                                                <td><a href="{{route('admin.users.show', $value)}}" >{{ $value->id }}</a></td>
                                                <td><a href="{{route('admin.users.show', $value)}}" >{{ $value->name }}</a></td>
                                                <td style="overflow:auto; max-width: 25%;"><a href="{{route('admusers.show', $value)}}" >{{ $value->email }}</a></td>
                                                <td class="text-center"><a href="{{route('admusers.show', $value)}}" >{{$ordered_products}}</a></td>
                                                <td class="d-none d-md-table-cell"><a href="{{route('admusers.show', $value)}}" >{{ $value->created_at->format('M d, Y') }}</a></td>
                                                <td class="d-none d-lg-table-cell"><a href="{{route('admusers.show', $value)}}" >{{ $value->updated_at->format('M d, Y') }}</a></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center" style="font: 50px bold;">No User Found</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr onclick="window.location.href = '{{route('admin.users.show', $value)}}'">
                                            <td><a href="{{route('admin.users.show', $value)}}" >{{ $value->id }}</a></td>
                                            <td><a href="{{route('admin.users.show', $value)}}" >{{ $value->name }}</a></td>
                                            <td style="overflow:auto; max-width: 25%;"><a href="{{route('admin.users.show', $value)}}" >{{ $value->email }}</a></td>
                                            <td class="text-center"><a href="{{route('admin.users.show', $value)}}" >{{$ordered_products}}</a></td>
                                            <td class="d-none d-md-table-cell"><a href="{{route('admin.users.show', $value)}}" >{{ $value->created_at->format('M d, Y') }}</a></td>
                                            <td class="d-none d-lg-table-cell"><a href="{{route('admin.users.show', $value)}}" >{{ $value->updated_at->format('M d, Y') }}</a></td>
                                        </tr>
                                    @endif
                                @endforeach                                                                   
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Show No Products Message -->
                    <div class="alert alert-warning text-center" style="min-height: 300px; font-size: 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <strong>No Users Found</strong>
                        
                        <!-- Button Below the Message -->
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-3">Add User</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
