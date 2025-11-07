@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Role' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter role name" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">Please enter the role name.</div>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group mb-3">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" placeholder="Enter display name" value="{{ old('display_name') }}" required>
                        <div class="invalid-feedback">Please enter the display name.</div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="invalid-feedback">Please select a status.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
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
