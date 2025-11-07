<!DOCTYPE html>
<html>
<head>
    <title>Module Settings PDF</title>
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
            background-color: #007BFF;
            color: white;
            display: table-header-group; /* Header muncul di setiap halaman PDF */
        }

        th, td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
            word-break: break-word;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        th {
            font-weight: bold;
            font-size: 13px;
        }

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
    <h2>Module Settings List</h2>

    @php
        // fallback kalau controller mengirim $moduleSettings atau $modulesettings atau tidak sama sekali
        $list = $moduleSettings ?? $modulesettings ?? collect();
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width:40px;">ID</th>
                <th>Module Name</th>
                <th>Key</th>
                <th>Value</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($list as $setting)
            <tr>
                <td>{{ $setting->id }}</td>
                <td>{{ $setting->module_name ?? '-' }}</td>
                <td>{{ $setting->key ?? '-' }}</td>
                <td>
                    @if(!empty($setting->value))
                        {{-- tampilkan multi-line value dengan rapi --}}
                        <pre style="white-space:pre-wrap; margin:0;">{{ $setting->value }}</pre>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $setting->created_at ? $setting->created_at->format('d M, Y H:i') : '-' }}</td>
                <td>{{ $setting->updated_at ? $setting->updated_at->format('d M, Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">No module settings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
