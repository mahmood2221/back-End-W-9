<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products Management Pro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- الهيدر العلوي وزر الإضافة --}}
            <div class="mb-6 flex justify-between items-center bg-white p-4 shadow-sm rounded-lg border-l-4 border-blue-500">
                <div>
                    <h3 class="text-lg font-bold text-gray-700">Inventory System</h3>
                    <p class="text-sm text-gray-500">Advanced searching and filtering for your products.</p>
                </div>
                <a href="{{ route('products.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition">
                    + Add New Product
                </a>
            </div>

            {{-- 1 & 2 & 3 & 5: Toolbar (Search, Filters, Sorting) --}}
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-100">
                <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                    
                    {{-- البحث بالاسم أو الوصف --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Product name or description..." 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    {{-- فلتر القسم --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Category</label>
                        <select name="category_id" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- فلتر المورد --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Supplier</label>
                        <select name="supplier_id" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                            <option value="">All Suppliers</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- الترتيب --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Sort By</label>
                        <select name="sort" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date: Newest</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        </select>
                    </div>

                    {{-- أزرار التحكم --}}
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-bold flex-1 transition">
                            Filter
                        </button>
                        <a href="{{ route('products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-md text-sm font-bold flex-1 text-center transition border border-gray-300">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Suppliers</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <span class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $product->category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-green-600">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4 text-sm text-blue-600 font-semibold">{{ $product->user->name ?? 'System' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($product->suppliers as $supplier)
                                                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded border border-blue-100">
                                                    {{ $supplier->name }}
                                                </span>
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
                                    </td>
                                </tr>
                            @empty
                                {{-- 5: Empty State --}}
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-500 font-medium">No products found matching your criteria.</span>
                                            <p class="text-gray-400 text-sm">Try adjusting your filters or search term.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- 4: Pagination with Query Persistence --}}
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>