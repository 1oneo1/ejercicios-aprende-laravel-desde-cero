<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['products' => auth()->user()->products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|max:64',
        //     'description' => 'required|max:64',
        //     'price' => 'required|numeric|gt:0',
        //     'has_battery' => 'required|boolean',
        //     'battery_duration' => 'required_if:has_battery,true|numeric|gt:0',
        //     'colors' => 'required|array',
        //     'colors.*' => 'required|string',
        //     'dimensions' => 'required|array|required_array_keys:width,height,length',
        //     'dimensions.*' => 'required|numeric|gt:0',
        //     'accessories' => 'required|array',
        //     'accessories.*' => 'array|required_array_keys:name,price',
        //     'accessories.*.name' => 'required|string',
        //     'accessories.*.price' => 'required|numeric|gt:0',
        // ]);

        $data = auth()->user()->products()->create($request->validated());

        // $data = $request->validated();

        // $res = Product::create($request->validated(), [...$data, 'user_id' => 1]);

        return response()->json(['message' => "Product created successfully", 'product' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return response()->json(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->validated());
        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully', 'product' => $product]);
    }
}
