<x-admin-layout>
  <!-- User Edit Form Card -->
  <div class="container-fluid mt-2">
    <div class="card">
      <div class="card-header text-center">
        <h2>Edit User</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

          <!-- User Name -->
          <div class="mb-2">
            <label for="user-name" class="form-label">Name</label>
            <input type="text" id="user-name" value="{{ $user->name }}" name="name" class="form-control form-control-sm" required />
          </div>

          <!-- User Email -->
          <div class="mb-2">
            <label for="user-email" class="form-label">Email</label>
            <input type="email" id="user-email" value="{{ $user->email }}" name="email" class="form-control form-control-sm" required />
          </div>

          <!-- Password (Optional) -->
          <div class="mb-4">
            <label for="user-password" class="form-label">Password</label>
            <input placeholder="Required user's password!" type="password" id="user-password" name="password" class="form-control form-control-sm" required/>
          </div>

          <!-- Submit Button -->
          <div class="mb-2">
            <button type="submit" id="submit-btn" class="btn btn-primary btn-md w-100">Update User</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</x-admin-layout>
