@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Edit Module Setting' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.module-settings.update', $moduleSetting->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Module Name -->
                    <div class="form-group mb-3">
                        <label for="module_name">Module Name</label>
                        <input type="text" name="module_name" id="module_name" class="form-control"
                               value="{{ old('module_name', $moduleSetting->module_name) }}" required>
                        <div class="invalid-feedback">Please enter the module name.</div>
                    </div>

                    <!-- Key -->
                    <div class="form-group mb-3">
                        <label for="key">Key</label>
                        <input type="text" name="key" id="key" class="form-control"
                               value="{{ old('key', $moduleSetting->key) }}" required>
                        <div class="invalid-feedback">Please enter the key name.</div>
                    </div>

                    <!-- Value -->
                    <div class="form-group mb-3">
                        <label for="value">Value</label>
                        <textarea name="value" id="value" class="form-control" rows="3"
                                  placeholder="Enter setting value">{{ old('value', $moduleSetting->value) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Setting</button>
                    <a href="{{ route('admin.module-settings.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
