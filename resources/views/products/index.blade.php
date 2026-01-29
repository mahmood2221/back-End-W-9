<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Management ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- الهيدر العلوي --}}
            <div class="mb-6 flex justify-between items-center bg-white p-4 shadow-sm rounded-lg border-l-4 border-blue-500">
                <div>
                    <h3 class="text-lg font-bold text-gray-700">Authenticated Inventory</h3>
                    <p class="text-sm text-gray-500">Manage products linked to your account.</p>
                </div>
                <a href="{{ route('products.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition">
                    + Add New Product
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                {{-- تم حذف فورم الفلترة والبحث للعودة لتاسك 07 --}}

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                {{-- المطلب رقم 7: إضافة عمود المالك --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Suppliers</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
    @forelse($products as $product)
    <tr>
        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category->name }}</td>
        <td class="px-6 py-4 text-sm font-bold text-green-600">${{ number_format($product->price, 2) }}</td>
        
        {{-- عرض المالك --}}
        <td class="px-6 py-4 text-sm text-blue-600 font-semibold">
            {{ $product->user->name ?? 'System' }}
        </td>

        {{-- إضافة عمود الموردين هنا --}}
        <td class="px-6 py-4">
            <div class="flex flex-wrap gap-1">
                @forelse($product->suppliers as $supplier)
                    <div class="inline-flex flex-col bg-blue-50 border border-blue-200 rounded px-2 py-1">
                        <span class="text-xs font-bold text-blue-700">{{ $supplier->name }}</span>
                        {{-- عرض سعر التكلفة من الجدول الوسيط --}}
                        <span class="text-[10px] text-blue-500">
                            Cost: ${{ number_format($supplier->pivot->cost_price, 2) }}
                        </span>
                    </div>
                @empty
                    <span class="text-gray-400 text-xs italic">No Suppliers</span>
                @endforelse
            </div>
        </td>

        <td class="px-6 py-4 text-sm font-medium">
            @can('update', $product)
                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-3 font-bold">Edit</a>
            @endcan

            @can('delete', $product)
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            @endcan
            
            @if(Auth::id() !== $product->user_id)
                <span class="text-gray-400 italic text-xs">Read Only</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        {{-- لاحظ أننا غيرنا colspan ليكون 6 لأننا أضفنا عموداً جديداً --}}
        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic bg-gray-50">
            No products available.
        </td>
    </tr>
    @endforelse
</tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>