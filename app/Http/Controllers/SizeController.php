<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        return response()->json($sizes);
    }
/**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:sizes,name',
            ]);

            $size = Size::create($validated);
            return response()->json(['success' => true,'message' => 'Size added successfully'], 201);
        }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return response()->json($size);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:sizes,name,' . $size->id,
        ]);

        $size->update($validated);
        return response()->json(['success' => true,'message' => 'Size updated successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return response()->json(['message' => 'Size deleted successfully']);
    }

}
