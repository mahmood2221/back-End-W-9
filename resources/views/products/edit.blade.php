<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

{{-- عرض جميع أخطاء التحقق --}}
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
    @error('price')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back to Products</a>

</body>
</html>
