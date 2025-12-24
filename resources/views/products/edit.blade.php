<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial;
        }
        .container {
            width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Name</label>
        <input type="text" name="name"
               value="{{ old('name', $product->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <br>

        <label>Price</label>
        <input type="number" name="price" step="0.01"
               value="{{ old('price', $product->price) }}">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror

        <br><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('products.index') }}">← Back to Products</a>
</div>

</body>
</html>
