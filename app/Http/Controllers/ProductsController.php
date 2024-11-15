<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductsController extends Controller
{
    public function showAllProducts()
    {
        $products = product::all();
        return response()->json($products);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('brand')->get();
        return Inertia::render('Products/Index', [
            'products' => ProductResource::collection($products)->resolve()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = brand::all();
        return Inertia::render('Products/Create', [
            'brands' => BrandResource::collection($brands)->resolve()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        product::create($request->validated());

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Products/Edit', ['product' => product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($request->validated());
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }
        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('products.index');
    }

    public function multipleDestroy(Request $request)
    {
        $ids = $request->ids;
        try {
            product::whereIn('id', $ids)->delete();
            return response()->json(['success' => "Data deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
