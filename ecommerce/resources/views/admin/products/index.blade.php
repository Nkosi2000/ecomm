@extends('layouts.admin')
@section('content')

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold uppercase text-[rgb(193,146,43)] mb-6">👕 Product Inventory</h1>

    {{-- Success message --}}
    @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    {{-- Add Product button --}}
    <div class="mb-4">
        <a href="{{ route('admin.products.create') }}"
           class="bg-[rgb(193,146,43)] text-black px-4 py-2 rounded hover:bg-black hover:text-white transition">
            ➕ Add Product
        </a>
    </div>

    {{-- Products table --}}
    <div class="bg-white p-6 rounded shadow">
        <table class="w-full table-auto text-left">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Stock</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    {{-- Product row --}}
                    <tr class="border-t">
                        <td class="px-4 py-2 font-semibold">{{ $p['id'] ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $p['name'] ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $p['category'] ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $p['stock'] ?? 0 }}</td>
                        <td class="px-4 py-2">{{ $p['price_display'] ?? '—' }}</td>
                        <td class="px-4 py-2 flex gap-3">
                            <a href="{{ route('admin.products.edit', $p['id']) }}"
                            class="text-[rgb(193,146,43)] hover:underline">Edit</a>
                            <button type="button"
                                    onclick="openDeleteModal('{{ $p['id'] }}', '{{ $p['name'] }}')"
                                    class="text-red-600 hover:underline">
                                Delete
                            </button>


                            {{-- @if(isset($p['variants']) && count($p['variants']) > 0)
                                <button type="button"
                                        onclick="toggleVariants('{{ $p['id'] }}')"
                                        id="toggle-btn-{{ $p['id'] }}"
                                        class="text-blue-600 hover:underline">
                                    Show Variants
                                </button>
                            @endif --}}
                        </td>
                    </tr>

                    @if(isset($p['variants']) && count($p['variants']) > 0)
                    @foreach ($p['variants'] as $variant)
                        <tr class="bg-gray-50 text-sm">
                            <td class="px-4 py-2 pl-8">↳ Variant #{{ $variant['id'] }}</td>
                            <td class="px-4 py-2">{{ $variant['color'] ?? '—' }} / {{ $variant['size'] ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $variant['stock'] ?? 0 }}</td>
                            <td class="px-4 py-2">
                                @if(isset($variant['price']))
                                    R{{ number_format($variant['price'], 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-4 py-2">…</td>
                        </tr>
                    @endforeach
                @endif
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4 text-red-600">Confirm Delete</h2>
        <p id="deleteMessage" class="mb-4 text-gray-700">Are you sure you want to delete this product?</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Script --}}
<script>
    function openDeleteModal(id, name) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteMessage').textContent =
            `Are you sure you want to delete "${name}"?`;
        document.getElementById('deleteForm').action =
            `/admin/products/${id}`;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

{{-- <script>
    function toggleVariants(productId) {
        const section = document.getElementById(`variants-${productId}`);
        const button = document.getElementById(`toggle-btn-${productId}`);

        if (!section || !button) return;

        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            button.textContent = 'Hide Variants';
        } else {
            section.classList.add('hidden');
            button.textContent = 'Show Variants';
        }
    }

    function openDeleteModal(id, name) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteMessage').textContent =
            `Are you sure you want to delete "${name}"?`;
        document.getElementById('deleteForm').action =
            `/admin/products/${id}`;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script> --}}

@endsection