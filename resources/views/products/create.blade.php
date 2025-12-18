<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

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

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br><br>

    <label>Price:</label><br>
    <input type="number" name="price" step="0.01" value="{{ old('price') }}">
    @error('price')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br><br>

    <button type="submit">Save</button>
</form>

<br>
<a href="{{ route('products.index') }}">Back to Products</a>

</body>
</html>
