<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandProductResource;
use App\Models\brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(brand $brand)
    {
        $products = $brand-> products()->get();
        return Inertia::render('Brands/BrandProducts', [
            'brand' => $brand,
            'products' => BrandProductResource::collection($products)->resolve()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
