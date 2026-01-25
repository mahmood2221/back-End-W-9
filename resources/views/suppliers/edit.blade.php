<x-app-layout>
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
        .my-input { width: 100%; padding: 8px; margin-top: 6px; border-radius: 4px; border: 1px solid #ccc; }
        .error { color: red; font-size: 14px; margin-top: 4px; }
        .save-btn { margin-top: 20px; width: 100%; background: #2563eb; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; }
        .save-btn:hover { background: #1e40af; }
    </style>

    <div class="py-6">
        <div class="my-container">
            <h1>Edit Supplier</h1>

            {{-- المتطلب 4: ملخص الأخطاء العام --}}
            @if ($errors->any())
                <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                    <strong>Please fix the errors below:</strong>
                </div>
            @endif

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                {{-- خطوة ضرورية في عملية التعديل --}}
                @method('PATCH') 

                <label class="my-label">Supplier Name</label>
                <input type="text" name="name" class="my-input" value="{{ old('name', $supplier->name) }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror

                <label class="my-label">Email Address</label>
                <input type="email" name="email" class="my-input" value="{{ old('email', $supplier->email) }}">
                @error('email') <div class="error">{{ $message }}</div> @enderror

                <button type="submit" class="save-btn">Update Supplier Information</button>
            </form>

            <a href="{{ route('suppliers.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #2563eb;">← Back to List</a>
        </div>
    </div>
</x-app-layout>