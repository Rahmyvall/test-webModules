<!DOCTYPE html>
<html>
<head>
    <title>Product Categories PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 4px;
            color: #fff;
            font-size: 11px;
        }
        .bg-success { background-color: #28a745; }
        .bg-secondary { background-color: #6c757d; }
    </style>
</head>
<body>
    <h2>Product Categories List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Display Order</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name ?? '-' }}</td>
                <td>{{ $category->slug ?? '-' }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                <td>
                    @if($category->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>{{ $category->display_order ?? '-' }}</td>
                <td>{{ $category->created_at ? $category->created_at->format('d M, Y H:i') : '-' }}</td>
                <td>{{ $category->updated_at ? $category->updated_at->format('d M, Y H:i') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
