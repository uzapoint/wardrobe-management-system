<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    // GET /api/clothes
    public function index()
    {
        // Fetch all clothing items and return as JSON
        return Cloth::all();
    }

    // POST /api/clothes
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:10',
            'color' => 'required|string|max:50',
            'image' => 'nullable|string',  // Optional field
        ]);

        // Create a new clothing item
        $cloth = Cloth::create($validated);

        // Return the newly created resource
        return response()->json($cloth, 201); // 201: Created
    }

    // GET /api/clothes/{id}
    public function show($id)
    {
        // Find the clothing item by ID
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Clothing item not found'], 404); // 404: Not Found
        }

        // Return the clothing item as JSON
        return response()->json($cloth);
    }

    // PUT /api/clothes/{id}
    public function update(Request $request, $id)
    {
        // Find the clothing item by ID
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Clothing item not found'], 404); // 404: Not Found
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:10',
            'color' => 'required|string|max:50',
            'image' => 'nullable|string',  // Optional field
        ]);

        // Update the clothing item
        $cloth->update($validated);

        // Return the updated clothing item
        return response()->json($cloth);
    }

    // DELETE /api/clothes/{id}
    public function destroy($id)
    {
        // Find the clothing item by ID
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json(['message' => 'Clothing item not found'], 404); // 404: Not Found
        }

        // Delete the clothing item
        $cloth->delete();

        // Return a success response
        return response()->json(['message' => 'Clothing item deleted'], 200);
    }
}
