<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clothes;
class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the list of clothes
    $clothes = Clothes::all();
    return response()->json($clothes, 200); // Return the list as JSON with a 200 status code
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'image' => 'nullable|image' // Ensure image is valid
        ]);
    
        $ImagePath = null;
    
        if ($request->hasFile('image')) {
            $ImagePath = $request->file('image')->store('uploads', 'public');
        }
    
        // Create the new record
        $clothe = Clothes::create([
            'name' => $request->name,
            'category' => $request->category,
            'size' => $request->size,
            'image' => $ImagePath,
        ]);
    
        return response()->json($clothe, 201); // Return the created resource with a 201 status code
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
    $request->validate([
        'name' => 'required',
        'category' => 'required',
        'size' => 'required',
        'image' => 'nullable|image'
    ]);

    $clothe = Clothes::findOrFail($id);

    if ($request->hasFile('image')) {
        $ImagePath = $request->file('image')->store('uploads', 'public');
        $clothe->image = $ImagePath;
    }

    $clothe->name = $request->name;
    $clothe->category = $request->category;
    $clothe->size = $request->size;

    $clothe->save();

    return response()->json($clothe, 200); // Return the updated resource as JSON
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $clothes = Clothes::findOrFail($id);
            $clothes->delete();
            return response()->json(['message' => 'Record deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
    
}
