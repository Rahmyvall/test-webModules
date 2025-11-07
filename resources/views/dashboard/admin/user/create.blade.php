@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create User' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">Please enter the name.</div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                        <div class="invalid-feedback">Please enter a password.</div>
                    </div>

                    <!-- Role -->
                    <div class="form-group mb-3">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a role.</div>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                        <div class="invalid-feedback">Please select a status.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Bootstrap custom validation
(function () {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();
</script>
@endsection
