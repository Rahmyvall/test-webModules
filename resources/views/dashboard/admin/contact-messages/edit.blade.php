@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Edit Message' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact-messages.update', $message->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Name (readonly) -->
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" value="{{ $message->name }}" readonly>
                    </div>

                    <!-- Email (readonly) -->
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ $message->email }}" readonly>
                    </div>

                    <!-- Phone -->
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" value="{{ $message->phone }}" readonly>
                    </div>

                    <!-- Subject -->
                    <div class="form-group mb-3">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" class="form-control" value="{{ $message->subject }}" readonly>
                    </div>

                    <!-- Message -->
                    <div class="form-group mb-3">
                        <label for="message">Message</label>
                        <textarea id="message" class="form-control" rows="6" readonly>{{ $message->message }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="new" {{ $message->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="archived" {{ $message->status == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        <div class="invalid-feedback">Please select the message status.</div>
                    </div>

                    <!-- Mark as read -->
                    <div class="form-group mb-3">
                        <label for="is_read">Read</label>
                        <select name="is_read" id="is_read" class="form-control" required>
                            <option value="0" {{ !$message->is_read ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $message->is_read ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Message</button>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Cancel</a>
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
