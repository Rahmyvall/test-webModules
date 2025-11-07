@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Message Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $message->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $message->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $message->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $message->subject ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>
                            @if(!empty($message->message))
                                <pre class="mb-0">{{ $message->message }}</pre>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($message->status ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Read</th>
                        <td>
                            @if($message->is_read)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $message->created_at ? $message->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $message->updated_at ? $message->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
