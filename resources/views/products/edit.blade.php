<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>

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
        .save-btn {
    display: block;        /* ضروري لكي يعمل الـ margin auto */
    width: 180px;          /* تحديد عرض صغير وثابت للزر */
    margin: 30px auto;     /* القيمة الأولى (30px) للمسافة العلوية، و auto لتوسيطه يميناً ويساراً */
    background: #2563eb;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    transition: background 0.3s ease;
}

.save-btn:hover {
    background: #1d4ed8;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); /* لمسة جمالية عند التمرير */
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
    <input type="text" name="name" value="{{ old('name', $product->name) }}">
    @error('name') <div class="error">{{ $message }}</div> @enderror

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
    @error('price') <div class="error">{{ $message }}</div> @enderror

    <label>Category</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <hr style="margin:20px 0">
    <h3>Suppliers</h3>

    @foreach($suppliers as $supplier)
        @php
            // جلب البيانات من جدول الوسيط (Pivot) لهذا المورد تحديداً
            $pivotData = $product->suppliers->find($supplier->id);
            
            $isSelected = old("suppliers.{$supplier->id}.selected", $pivotData ? '1' : '');
            $costPrice = old("suppliers.{$supplier->id}.cost_price", $pivotData->pivot->cost_price ?? '');
            $leadTime = old("suppliers.{$supplier->id}.lead_time_days", $pivotData->pivot->lead_time_days ?? '');
        @endphp

        <div style="margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
            <label style="display:inline; font-weight:normal;">
                <input type="checkbox" name="suppliers[{{ $supplier->id }}][selected]" value="1" {{ $isSelected ? 'checked' : '' }}>
                {{ $supplier->name }}
            </label>

            <input type="number" step="0.01" name="suppliers[{{ $supplier->id }}][cost_price]" 
                   value="{{ $costPrice }}" placeholder="Cost Price" style="width: 100px; display:inline; margin-left:10px;">

            <input type="number" name="suppliers[{{ $supplier->id }}][lead_time_days]" 
                   value="{{ $leadTime }}" placeholder="Lead Time" style="width: 100px; display:inline; margin-left:10px;">

            @error("suppliers.$supplier->id.cost_price") <div class="error">{{ $message }}</div> @enderror
            @error("suppliers.$supplier->id.lead_time_days") <div class="error">{{ $message }}</div> @enderror
        </div>
    @endforeach

    <button type="submit">Update Product</button>
</form>
    <a href="{{ route('products.index') }}">← Back to Products</a>
</div>

</body>
</html>
