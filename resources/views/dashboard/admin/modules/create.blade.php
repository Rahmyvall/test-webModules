@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Module' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.modules.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Module Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter module name" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">Please enter the module name.</div>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group mb-3">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control"
                            placeholder="Enter display name" value="{{ old('display_name') }}" required>
                        <div class="invalid-feedback">Please enter the display name.</div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            placeholder="Enter module description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Version -->
                    <div class="form-group mb-3">
                        <label for="version">Version</label>
                        <input type="text" name="version" id="version" class="form-control"
                            placeholder="Enter version (e.g., 1.0.0)" value="{{ old('version') }}">
                    </div>

                    <!-- Installed At -->
                    <div class="form-group mb-3">
                        <label for="installed_at">Installed At</label>
                        <input type="datetime-local" name="installed_at" id="installed_at" class="form-control"
                            value="{{ old('installed_at') }}">
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
                    <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">Cancel</a>
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
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>
@endsection
