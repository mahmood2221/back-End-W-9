<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 25px;">
                <h3 style="margin-top: 0;">Welcome, {{ auth()->user()->name }}!</h3>
                <p style="color: #555;">You can now manage your products and link them with suppliers easily.</p>
            </div>

            <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
               <h3 style="margin-top: 0; margin-bottom: 20px; font-size: 18px; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px;">
    All System Products
</h3>

<table style="width: 100%; border-collapse: collapse; text-align: left;">
    <thead>
        <tr style="background-color: #f9fafb;">
            <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Product Name</th>
            <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Owner (Created By)</th>
            <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Suppliers</th>
            <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Price</th>
        </tr>
    </thead>
    <tbody>
        @forelse($latestProducts as $product)
        <tr>
            <td style="padding: 12px; border-bottom: 1px solid #e5e7eb; font-weight: bold;">{{ $product->name }}</td>
            
            {{-- هنا سيظهر اسم أي مستخدم قام بإنشاء المنتج --}}
            <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                <span style="color: #4b5563; font-style: italic;">
                    {{ $product->user->name ?? 'Unknown User' }}
                </span>
            </td>

            <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                @foreach($product->suppliers as $supplier)
                    <span style="display: inline-block; background: #f0fdf4; color: #166534; padding: 2px 8px; border-radius: 12px; font-size: 11px; border: 1px solid #bbf7d0;">
                        {{ $supplier->name }}
                    </span>
                @endforeach
            </td>

            <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">${{ $product->price }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="padding: 20px; text-align: center; color: #9ca3af;">No products available in the system.</td>
        </tr>
        @endforelse
    </tbody>
</table>

                <div style="margin-top: 15px;">
                    <a href="{{ route('products.index') }}" style="color: #3b82f6; text-decoration: none; font-size: 14px; font-weight: bold;">
                        Go to Product Management →
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>