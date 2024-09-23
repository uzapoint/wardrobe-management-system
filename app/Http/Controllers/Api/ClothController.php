<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
        return Cloth::all();
        
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
        
      // Validate the request before storing
      $validatedData = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'size' => 'required|string',
        'color' => 'required|string',
        'image' => 'nullable|string'
    ]);

    // Create a new clothing item using the validated data
    $cloth = Cloth::create($validatedData);

    // Return a success response with the created item
    return response()->json;
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
