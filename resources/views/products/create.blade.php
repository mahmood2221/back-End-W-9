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
<h3 class="my-label">Suppliers Details</h3>

@foreach($suppliers as $supplier)
    <div style="margin-bottom:15px; border:1px solid #eee; padding:15px; border-radius:8px; background:#f9f9f9;">
        <label style="display:flex; align-items:center; font-weight:bold; margin-bottom:10px;">
            <input type="checkbox" name="suppliers[{{ $supplier->id }}][selected]" value="1" style="margin-right:10px;">
            {{ $supplier->name }}
        </label>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
            <div>
                <label style="font-size:12px; color:#666;">Cost Price ($)</label>
                <input type="number" step="0.01" name="suppliers[{{ $supplier->id }}][cost_price]" class="my-input" placeholder="0.00">
            </div>
            <div>
                <label style="font-size:12px; color:#666;">Lead Time (Days)</label>
                <input type="number" name="suppliers[{{ $supplier->id }}][lead_time_days]" class="my-input" placeholder="e.g. 5">
            </div>
        </div>
    </div>
@endforeach
</div>

                <button type="submit" class="save-btn">Save Product</button>
            </form>

            <a href="{{ route('products.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #2563eb;">← Back to Products</a>
        </div>
    </div>
</x-app-layout>