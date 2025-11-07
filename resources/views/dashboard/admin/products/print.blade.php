<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Blog Posts' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>
    <h2>{{ $title ?? 'Blog Posts' }}</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Status</th>
                <th>Published At</th>
                <th>Excerpt</th>
                <th>Featured Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogPosts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name ?? '-' }}</td>
                <td>{{ $post->author->name ?? '-' }}</td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>{{ $post->published_at?->format('d M Y H:i') ?? '-' }}</td>
                <td>{{ $post->excerpt ?? '-' }}</td>
                <td>
                    @if($post->featured_image)
                        <img src="{{ public_path('storage/' . $post->featured_image) }}" alt="Featured Image">
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
