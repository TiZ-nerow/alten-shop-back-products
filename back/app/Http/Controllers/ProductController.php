<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Product::all(),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $safe = $request->validate([
            'code'            => 'required|max:255|unique:products',
            'name'            => 'required|max:255',
            'description'     => 'required|max:255',
            'price'           => 'required|numeric|min:0',
            'quantity'        => 'required|numeric|min:0',
            'category'        => 'required|max:255',
            'image'           => 'nullable',
            'rating'          => 'nullable|numeric|between:0,5',
        ]);

        return response()->json(
            Product::create($safe),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            Product::findOrFail($id),
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $safe = $request->validate([
            'code'            => 'sometimes|required|max:255|unique:products',
            'name'            => 'sometimes|required|max:255',
            'description'     => 'sometimes|required|max:255',
            'price'           => 'sometimes|required|numeric|min:0',
            'quantity'        => 'sometimes|required|numeric|min:0',
            'category'        => 'sometimes|required|max:255',
            'image'           => 'nullable',
            'rating'          => 'nullable|numeric|between:0,5',
        ]);

        return response()->json(
            tap(Product::findOrFail($id))->update($safe),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(
            tap(Product::findOrFail($id))->delete(),
            Response::HTTP_OK
        );
    }
}
