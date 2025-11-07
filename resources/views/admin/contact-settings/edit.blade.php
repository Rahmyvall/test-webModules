@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="page-title">{{ $title ?? 'Edit Contact Setting' }}</h1>

    <form action="{{ route('admin.contact-settings.update', $setting->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="key" class="form-label">Key</label>
            <input type="text" name="key" id="key" class="form-control @error('key') is-invalid @enderror" value="{{ old('key', $setting->key) }}" required>
            @error('key')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <textarea name="value" id="value" class="form-control @error('value') is-invalid @enderror" rows="3">{{ old('value', $setting->value) }}</textarea>
            @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.contact-settings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
