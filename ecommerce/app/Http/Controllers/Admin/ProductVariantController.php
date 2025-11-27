<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
    /**
     * Store a new variant for a product
     */
    public function store(Request $request, SupabaseService $supabase, $productId)
    {
        $validated = $request->validate([
            'sku'   => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size'  => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        $payload = array_merge($validated, ['product_id' => (int) $productId]);

        try {
            $supabase->from('product_variants')->insert($payload);
            return back()->with('status', 'Variant added successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase variant insert failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'Could not add variant.']);
        }
    }

    /**
     * Update an existing variant
     */
    public function update(Request $request, SupabaseService $supabase, $variantId)
    {
        $validated = $request->validate([
            'sku'   => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size'  => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        try {
            $result = $supabase->from('product_variants')->update($validated, ['id' => "eq.$variantId"]);
            if (empty($result)) {
                return back()->withErrors(['supabase' => 'No variant was updated.']);
            }
            return back()->with('status', 'Variant updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase variant update failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'Could not update variant.']);
        }
    }

    /**
     * Delete a variant
     */
    public function destroy(SupabaseService $supabase, $variantId)
    {
        try {
            $supabase->from('product_variants')->delete(['id' => "eq.$variantId"]);
            return back()->with('status', 'Variant deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase variant delete failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'Could not delete variant.']);
        }
    }
}