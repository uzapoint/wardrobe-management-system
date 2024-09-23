<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clothes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        //
        $clothes = Clothes::all();
        return response()->json($clothes);
        
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }

        
        $validatedData['user_id'] = auth()->id(); // Set user_id to the authenticated user's ID

    
    // Create a new clothing item using the validated data
    $clothes = Clothes::create($validatedData);

    // Return a success response with the created item
    // Use response()->json here
    return response()->json($clothes, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $cloth = Clothes::findOrFail($id);
        return response()->json($cloth);
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
    public function update(Request $request, $id)
    {
        // Attempt to find the cloth by ID
        $cloth = Clothes::findOrFail($id);
    
        // Check if the authenticated user is the owner
        if ($cloth->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'category' => 'string',
            'size' => 'string',
            'color' => 'string',
            'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($cloth->image) {
                Storage::disk('public')->delete($cloth->image);
            }
    
            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $path;
        }
    
        // Update the cloth with validated data
        $cloth->fill($validatedData); // Ensure fillable fields are updated
        $cloth->save(); // Save the updated model
    
        // Fetch the updated cloth data with image URL
        $cloth->image = $cloth->image ? url('storage/' . $cloth->image) : null;
    
        // Return the updated cloth data in the response
        return response()->json($cloth, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cloth = Clothes::findOrFail($id);

        if ($cloth->image) {
            Storage::disk('public')->delete($cloth->image);
        }

        $cloth->delete();

        return response()->json(['message' => 'Successfully deleted'], 200);
    }
}
