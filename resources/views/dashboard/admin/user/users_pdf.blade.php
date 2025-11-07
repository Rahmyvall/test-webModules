<!DOCTYPE html>
<html>
<head>
    <title>Users PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        thead {
            background-color: #4CAF50;
            color: white;
            display: table-header-group; /* agar header muncul di setiap halaman PDF */
        }

        th, td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        th {
            font-weight: bold;
            font-size: 13px;
        }

        /* Badge styles for status */
        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }

        .badge-inactive {
            background-color: #6c757d;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }

        .badge-suspended {
            background-color: #dc3545;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table>
        <thead>
            <tr>
                <th style="width:50px;">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role?->name ?? '-' }}</td>
                <td>
                    @if($user->status == 'active')
                        <span class="badge-active">{{ ucfirst($user->status) }}</span>
                    @elseif($user->status == 'inactive')
                        <span class="badge-inactive">{{ ucfirst($user->status) }}</span>
                    @else
                        <span class="badge-suspended">{{ ucfirst($user->status) }}</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d M, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
