<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(SupabaseService $supabase)
    {
        try {
            // Fetch all products
            $products = $supabase->from('products')->select('*');

            // Attach variants, compute stock totals and price ranges
            foreach ($products as &$product) {
                $variants = $supabase->from('product_variants')->select('*', [
                    'product_id' => "eq.{$product['id']}"
                ]);
                $product['variants'] = $variants;

                // Stock: sum variant stock if variants exist
                if (!empty($variants)) {
                    $product['stock'] = array_sum(array_column($variants, 'stock'));

                    // Price: compute min and max from variants
                    $prices = array_column($variants, 'price');
                    $prices = array_filter($prices, fn($p) => $p !== null);

                    if (!empty($prices)) {
                        $minPrice = min($prices);
                        $maxPrice = max($prices);

                        // Show range if min != max, else single price
                        $product['price_display'] = $minPrice == $maxPrice
                            ? "R" . number_format($minPrice, 2)
                            : "R" . number_format($minPrice, 2) . " – R" . number_format($maxPrice, 2);
                    } else {
                        // fallback to product base price
                        $product['price_display'] = "R" . number_format($product['price'] ?? 0, 2);
                    }
                } else {
                    // No variants: use product base price
                    $product['price_display'] = "R" . number_format($product['price'] ?? 0, 2);
                }
            }

        } catch (\Throwable $e) {
            Log::error('Supabase fetch products failed', ['error' => $e->getMessage()]);
            $products = [];
            return back()->withErrors(['supabase' => 'Unable to load products. Please try again later.']);
        }

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request, SupabaseService $supabase)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock'    => 'required|integer|min:0',
            'price'    => 'required|numeric|min:0',
        ]);

        try {
            $supabase->from('products')->insert($validated);
            return redirect()->route('admin.products.index')
                ->with('status', 'Product created successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase insert failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'We could not save the product. Please try again.']);
        }
    }

    public function edit($id, SupabaseService $supabase)
    {
        try {
            // Fetch the product
            $productRows = $supabase->from('products')->select('*', ['id' => "eq.$id"]);
            $product = $productRows[0] ?? null;

            // Fetch variants for this product
            $variants = $supabase->from('product_variants')->select('*', ['product_id' => "eq.$id"]);
        } catch (\Throwable $e) {
            Log::error('Supabase fetch product/variants failed', ['error' => $e->getMessage()]);
            return redirect()->route('admin.products.index')
                ->withErrors(['supabase' => 'Could not load product.']);
        }

        if (!$product) {
            return redirect()->route('admin.products.index')
                ->withErrors(['supabase' => 'Product not found.']);
        }

        // Pass both product and variants to the view
        return view('admin.products.edit', compact('product', 'variants'));
    }

    public function update(Request $request, $id, SupabaseService $supabase)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'stock'    => 'required|integer|min:0',
            'price'    => 'required|numeric|min:0',
        ]);

        try {
            // ✅ Supabase requires eq. operator for filters
            $result = $supabase->from('products')->update($validated, ['id' => "eq.$id"]);

            if (empty($result)) {
                return back()->withErrors(['supabase' => 'No product was updated.']);
            }

            return redirect()->route('admin.products.index')
                ->with('status', 'Product updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase update failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'We could not update the product. Please try again later.']);
        }


    }

    public function destroy($id, SupabaseService $supabase)
    {
        try {
            // ✅ Supabase requires eq. operator for filters
            $supabase->from('products')->delete(['id' => "eq.$id"]);
            return redirect()->route('admin.products.index')
                ->with('status', 'Product deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Supabase delete failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['supabase' => 'We could not delete the product. Please try again later.']);
        }
    }
}