<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 4px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #1e40af;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Add Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ old('price') }}">
        @error('price') <div class="error">{{ $message }}</div> @enderror

        <label>Category</label>
        <select name="category_id">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <div class="error">{{ $message }}</div> @enderror

        <hr style="margin:20px 0">

<h3>Suppliers</h3>

@foreach($suppliers as $supplier)
    <div style="margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
        <label>
            <input type="checkbox"
                   name="suppliers[{{ $supplier->id }}][selected]"
                   value="1"
                   {{ old("suppliers.$supplier->id.selected") ? 'checked' : '' }}>
            {{ $supplier->name }}
        </label>

        <input type="number" step="0.01"
               name="suppliers[{{ $supplier->id }}][cost_price]"
               placeholder="Cost Price"
               value="{{ old("suppliers.$supplier->id.cost_price") }}">

        <input type="number"
               name="suppliers[{{ $supplier->id }}][lead_time_days]"
               placeholder="Lead Time (days)"
               value="{{ old("suppliers.$supplier->id.lead_time_days") }}">

        @error("suppliers.$supplier->id.cost_price")
            <div class="error">{{ $message }}</div>
        @enderror

        @error("suppliers.$supplier->id.lead_time_days")
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
@endforeach


        <button type="submit">Save Product</button>
    </form>

    <a href="{{ route('products.index') }}">← Back to Products</a>
</div>

</body>
</html>
