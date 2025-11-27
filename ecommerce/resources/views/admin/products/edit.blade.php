@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto p-6">

    {{-- Product Edit Form --}}
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>
    <form action="{{ route('admin.products.update', $product['id']) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" value="{{ $product['name'] }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Category</label>
            <input type="text" name="category" value="{{ $product['category'] }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Stock</label>
            <input type="number" name="stock" value="{{ $product['stock'] }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Price</label>
            <input type="number" step="0.01" name="price" value="{{ $product['price'] }}" class="w-full border px-3 py-2 rounded">
        </div>

        <button class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded">Save Product</button>
    </form>

    {{-- Variants Section --}}
    <h2 class="text-xl font-bold mt-10 mb-4">Variants</h2>

    <table class="w-full table-auto border-collapse mb-6">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2">SKU</th>
                <th class="px-4 py-2">Color</th>
                <th class="px-4 py-2">Size</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($variants as $variant)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $variant['sku'] ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $variant['color'] ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $variant['size'] ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $variant['stock'] }}</td>
                    <td class="px-4 py-2">
                        @if(isset($variant['price']))
                            R{{ number_format($variant['price'], 2) }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        {{-- Update Variant --}}
                        <form action="{{ route('admin.variants.update', $variant['id']) }}" method="POST" class="flex gap-2">
                            @csrf @method('PUT')
                            <input type="text" name="sku" value="{{ $variant['sku'] ?? '' }}" class="border px-2 py-1 w-20">
                            <input type="text" name="color" value="{{ $variant['color'] ?? '' }}" class="border px-2 py-1 w-20">
                            <input type="text" name="size" value="{{ $variant['size'] ?? '' }}" class="border px-2 py-1 w-20">
                            <input type="number" name="stock" value="{{ $variant['stock'] }}" class="border px-2 py-1 w-20">
                            <input type="number" step="0.01" name="price" value="{{ $variant['price'] ?? '' }}" class="border px-2 py-1 w-24">
                            <button class="bg-[rgb(193,146,43)] text-black px-3 py-1 rounded">Save</button>
                        </form>

                        {{-- Delete Variant --}}
                        <form action="{{ route('admin.variants.destroy', $variant['id']) }}" method="POST" onsubmit="return confirm('Delete this variant?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No variants yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Add New Variant --}}
    <form action="{{ route('admin.variants.store', $product['id']) }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-3">
        @csrf
        <input type="text" name="sku" class="border px-3 py-2" placeholder="SKU">
        <input type="text" name="color" class="border px-3 py-2" placeholder="Color">
        <input type="text" name="size" class="border px-3 py-2" placeholder="Size">
        <input type="number" name="stock" class="border px-3 py-2" min="0" placeholder="Stock" required>
        <input type="number" step="0.01" name="price" class="border px-3 py-2" min="0" placeholder="Price">
        <button class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded">Add Variant</button>
    </form>

</div>
@endsection