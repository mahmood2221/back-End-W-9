<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $product->name }}" required><br><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}" required><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
