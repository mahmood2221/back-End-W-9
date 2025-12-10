<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Price:</label>
    <input type="number" name="price" step="0.01" required><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
