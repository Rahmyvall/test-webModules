@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'User Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ $user->role->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($user->status) }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Last Login</th>
                        <td>{{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
