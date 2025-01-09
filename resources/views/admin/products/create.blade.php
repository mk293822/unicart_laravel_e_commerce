<x-admin-layout>
  <!-- Product Add Form Card -->
  <div class="container-fluid mt-2">
    <div class="card">
      <div class="card-header text-center">
        <h2>Add New Product</h2>
      </div>
      <div class="card-body">
        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

          <!-- Product Name -->
          <div class="mb-2">
            <label for="product-name" class="form-label">Product Name</label>
            <input type="text" id="product-name" name="name" class="form-control form-control-sm" required />
          </div>

          <!-- Product Description -->
          <div class="mb-2">
            <label for="product-description" class="form-label">Description</label>
            <input type="text" id="product-description" name="description" class="form-control form-control-sm" required />
          </div>

          <!-- Stock -->
          <div class="mb-2">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" min="1" class="form-control form-control-sm" required />
          </div>

          <!-- Price -->
          <div class="mb-2">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control form-control-sm" step="0.01" required />
          </div>

          <!-- Product Image -->
          <div class="mb-2">
            <label for="product-image" class="form-label">Product Image</label>
            <input type="file" id="product-image" name="image" class="form-control form-control-sm" accept="image/*" required />
          </div>

          <!-- Product Category Select -->
          <div class="mb-3">
            <label for="product-category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select form-select-sm custom-select">
              <option value="">Select Category</option>
              @foreach ($categories as $item)
                <option value="{{$item->name}}">{{$item->name}}</option>
              @endforeach
            </select>
          </div>

          <!-- Submit Button -->
          <div class="mb-2">
            <button type="submit" class="btn btn-primary btn-md w-100">Add Product</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</x-admin-layout>
