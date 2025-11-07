<!DOCTYPE html>
<html>
<head>
    <title>Roles PDF</title>
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
            display: table-header-group; /* Header muncul di setiap halaman PDF */
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

        .badge-unknown {
            background-color: #dc3545;
            color: white;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <h2>Roles List</h2>

    <table>
        <thead>
            <tr>
                <th style="width:50px;">ID</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->description ?? '-' }}</td>
                <td>
                    @if($role->status == 'active')
                        <span class="badge-active">Active</span>
                    @elseif($role->status == 'inactive')
                        <span class="badge-inactive">Inactive</span>
                    @else
                        <span class="badge-unknown">{{ ucfirst($role->status ?? 'Unknown') }}</span>
                    @endif
                </td>
                <td>{{ $role->created_at?->format('d M, Y') ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
