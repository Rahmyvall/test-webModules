@extends('layouts.print') <!-- layout khusus print -->

@section('content')
<h2 style="text-align:center; margin-bottom:20px;">{{ $title }}</h2>

<table style="width:100%; border-collapse: collapse; font-size:12px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="border:1px solid #000; padding:5px; width:30px;">#</th>
            <th style="border:1px solid #000; padding:5px;">Title</th>
            <th style="border:1px solid #000; padding:5px; width:100px;">Category</th>
            <th style="border:1px solid #000; padding:5px; width:100px;">Author</th>
            <th style="border:1px solid #000; padding:5px; width:80px;">Status</th>
            <th style="border:1px solid #000; padding:5px; width:120px;">Published At</th>
            <th style="border:1px solid #000; padding:5px; width:60px;">Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogPosts as $post)
        <tr>
            <td style="border:1px solid #000; padding:5px; text-align:center;">{{ $loop->iteration }}</td>
            <td style="border:1px solid #000; padding:5px;">{{ $post->title }}</td>
            <td style="border:1px solid #000; padding:5px;">{{ $post->category->name ?? '-' }}</td>
            <td style="border:1px solid #000; padding:5px;">{{ $post->author->name ?? '-' }}</td>
            <td style="border:1px solid #000; padding:5px; text-align:center;">{{ ucfirst($post->status) }}</td>
            <td style="border:1px solid #000; padding:5px; text-align:center;">{{ $post->published_at?->format('d M Y H:i') ?? '-' }}</td>
            <td style="border:1px solid #000; padding:5px; text-align:center;">
                @if($post->featured_image)
                    <img src="{{ public_path('storage/' . $post->featured_image) }}" alt="Image" style="width:50px; height:50px; object-fit:cover;">
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
