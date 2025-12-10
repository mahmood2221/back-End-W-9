<!DOCTYPE html>
<html>
<head>
    <title>Products List</title>
</head>
<body>

<h1>Products</h1>
<a href="{{ route('products.create') }}">Add New Product</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Price</th><th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete product?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

</body>
</html>
