@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Module Setting' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.module-settings.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Module Name -->
                    <div class="form-group mb-3">
                        <label for="module_name">Module Name</label>
                        <input type="text" name="module_name" id="module_name" class="form-control"
                            placeholder="Enter module name (e.g., User Management)" value="{{ old('module_name') }}" required>
                        <div class="invalid-feedback">Please enter the module name.</div>
                    </div>

                    <!-- Key -->
                    <div class="form-group mb-3">
                        <label for="key">Setting Key</label>
                        <input type="text" name="key" id="key" class="form-control"
                            placeholder="Enter setting key (e.g., max_login_attempts)" value="{{ old('key') }}" required>
                        <div class="invalid-feedback">Please enter the setting key.</div>
                    </div>

                    <!-- Value -->
                    <div class="form-group mb-3">
                        <label for="value">Setting Value</label>
                        <textarea name="value" id="value" class="form-control"
                            placeholder="Enter setting value (optional)">{{ old('value') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <small class="text-muted">
                            Note: Each <strong>module_name</strong> and <strong>key</strong> combination must be unique.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.module-settings.index') }}" class="btn btn-secondary">Cancel</a>
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
