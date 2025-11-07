@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Edit Module' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.modules.update', $module->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Module Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $module->name) }}" required>
                        <div class="invalid-feedback">Please enter the module name.</div>
                    </div>

                    <!-- Display Name -->
                    <div class="form-group mb-3">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" id="display_name" class="form-control"
                               value="{{ old('display_name', $module->display_name) }}" required>
                        <div class="invalid-feedback">Please enter display name.</div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"
                                  rows="3">{{ old('description', $module->description) }}</textarea>
                    </div>

                    <!-- Version -->
                    <div class="form-group mb-3">
                        <label for="version">Version</label>
                        <input type="text" name="version" id="version" class="form-control"
                               value="{{ old('version', $module->version) }}">
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status', $module->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $module->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="invalid-feedback">Please select a status.</div>
                    </div>

                    <!-- Installed At -->
                    <div class="form-group mb-3">
                        <label for="installed_at">Installed At</label>
                        <input type="datetime-local" name="installed_at" id="installed_at" class="form-control"
                               value="{{ old('installed_at', $module->installed_at ? $module->installed_at->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Module</button>
                    <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">Cancel</a>
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
