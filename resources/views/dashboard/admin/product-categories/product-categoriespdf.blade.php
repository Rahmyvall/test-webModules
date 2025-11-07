<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border:1px solid #000;
            padding:5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>{{ $title }}</h3>
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
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->parent->name ?? '-' }}</td>
                <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                <td>{{ $category->display_order ?? '-' }}</td>
                <td>{{ $category->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
