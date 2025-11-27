@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-[rgb(193,146,43)]">➕ Add Product</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Category</label>
            <input type="text" name="category" value="{{ old('category') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="0" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium">Price (R)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border rounded p-2 focus:ring focus:ring-[rgb(193,146,43)]"
                   min="0" required>
        </div>

        <button type="submit"
                class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
            Save Product
        </button>
    </form>
</div>
@endsection