<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        .add-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-btn:hover {
            background: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2563eb;
            color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .actions a {
            margin-right: 6px;
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

        .actions form {
            display: inline;
        }

        .actions button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions button:hover {
            background: #b91c1c;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="add-btn">+ Add New Product</a>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price ($)</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="actions">
                    <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
