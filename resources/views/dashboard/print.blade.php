<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            font-family: "Inter", "Segoe UI", sans-serif;
            padding: 40px 0;
        }

        .print-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            max-width: 900px;
            margin: auto;
        }

        h1, h2, h3, h4 {
            font-weight: 700;
        }

        .btn-modern {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .print-container {
                box-shadow: none;
                padding: 0;
                border-radius: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="print-container">
            <div class="no-print mb-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0 text-primary">📦 Product Detail</h4>
                <div>
                    <button onclick="window.print()" class="btn btn-primary btn-modern me-2">🖨️ Print</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-modern">⬅ Back</a>
                </div>
            </div>

            <h2 class="fw-bold mb-4">{{ $product->name }}</h2>

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-4 shadow-sm" alt="{{ $product->name }}">
            @endif

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>SKU</th>
                        <td>{{ $product->sku ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($product->status) }}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{{ $product->short_description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! nl2br(e($product->description)) !!}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>${{ number_format($product->price, 2) }}</td>
                    </tr>
                    @if($product->discount_price)
                    <tr>
                        <th>Discount Price</th>
                        <td>${{ number_format($product->discount_price, 2) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    @if($product->weight)
                    <tr>
                        <th>Weight</th>
                        <td>{{ $product->weight }} kg</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
