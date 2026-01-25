<x-app-layout>
    {{-- نضع كود الـ CSS الخاص بك هنا لضمان عدم تأثر شكل الصفحة --}}
    <style>
        .my-container {
            max-width: 450px;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }
        .my-label { font-weight: bold; display: block; margin-top: 15px; }
        .my-input, .my-select { width: 100%; padding: 8px; margin-top: 6px; border-radius: 4px; border: 1px solid #ccc; }
        .error { color: red; font-size: 14px; margin-top: 4px; }
        .save-btn { margin-top: 20px; width: 100%; background: #2563eb; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; }
        .save-btn:hover { background: #1e40af; }
    </style>

    <div class="py-6">
        <div class="my-container">
            <h1>Add Product</h1>

            {{-- المتطلب 4: ملخص الأخطاء العام في أعلى الفورم --}}
            @if ($errors->any())
                <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                    <strong>Validation Errors:</strong>
                    <ul style="margin-left: 20px; font-size: 13px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <label class="my-label">Name</label>
                <input type="text" name="name" class="my-input" value="{{ old('name') }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror

                <label class="my-label">Price</label>
                <input type="number" step="0.01" name="price" class="my-input" value="{{ old('price') }}">
                @error('price') <div class="error">{{ $message }}</div> @enderror

                <label class="my-label">Category</label>
                <select name="category_id" class="my-select">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <div class="error">{{ $message }}</div> @enderror

                <hr style="margin:20px 0">
                <h3>Suppliers</h3>

                @foreach($suppliers as $supplier)
                    @php
                        $isSelected = old("suppliers.{$supplier->id}.selected");
                        $costPrice = old("suppliers.{$supplier->id}.cost_price");
                        $leadTime = old("suppliers.{$supplier->id}.lead_time_days");
                    @endphp

                    <div style="margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                        <label>
                            <input type="checkbox" name="suppliers[{{ $supplier->id }}][selected]" value="1" {{ $isSelected ? 'checked' : '' }}>
                            {{ $supplier->name }}
                        </label>

                        <input type="number" step="0.01" class="my-input" name="suppliers[{{ $supplier->id }}][cost_price]" placeholder="Cost Price" value="{{ $costPrice }}">
                        <input type="number" class="my-input" name="suppliers[{{ $supplier->id }}][lead_time_days]" placeholder="Lead Time (days)" value="{{ $leadTime }}">

                        @error("suppliers.$supplier->id.cost_price") <div class="error">{{ $message }}</div> @enderror
                        @error("suppliers.$supplier->id.lead_time_days") <div class="error">{{ $message }}</div> @enderror
                    </div>
                @endforeach

                <button type="submit" class="save-btn">Save Product</button>
            </form>

            <a href="{{ route('products.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #2563eb;">← Back to Products</a>
        </div>
    </div>
</x-app-layout>