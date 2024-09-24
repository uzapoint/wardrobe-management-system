<?php

namespace App\Http\Controllers\API;

use App\Models\Clothes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClothesRequest;
use App\Http\Requests\UpdateClothesRequest;
use Illuminate\Support\Facades\File;

class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clothes = Clothes::with(['category', 'user:id,name'])
            // ->where('user_id', 1)
            ->where('user_id', auth()->id())
            ->paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Clothes fetched successfully',
            'data' => $clothes
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClothesRequest $request)
    {
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $image = $request->file('file');

            if ($image->isValid() && $image->getSize() <= 2048 * 1024) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/' . $imageName;

                $image->move(public_path('images'), $imageName);

                $validated['image'] = $imagePath; // Store only the image path
            }
        }

        $validated['user_id'] = auth()->id(); 
        $clothes = Clothes::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Clothes created successfully',
            'data' => $clothes
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $clothes = Clothes::with('category')->where('user_id', auth()->id())->findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Clothes fetched successfully',
                'data' => $clothes
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Clothes not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClothesRequest $request, string $id)
    {
        try {
            // Find the clothing item for the authenticated user
            $clothes = Clothes::where('user_id', auth()->id())->findOrFail($id);
            $validated = $request->validated();
    
            // Handle file upload if the image is provided
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
    
                // Check image validity and size limit
                if ($image->isValid() && $image->getSize() <= 2048 * 1024) {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'images/' . $imageName;
    
                    // Move the uploaded file to the public images directory
                    $image->move(public_path('images'), $imageName);
    
                    // Delete the old image if it exists
                    if (File::exists(public_path($clothes->image))) {
                        File::delete(public_path($clothes->image));
                    }
    
                    // Set the new image path in validated data
                    $validated['image'] = $imagePath; 
                }
            }
    
            // Update the clothing item with validated data
            $clothes->update($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Clothes updated successfully',
                'data' => $clothes
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the clothes: ' . $e->getMessage()
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $clothes = Clothes::where('user_id', auth()->id())->findOrFail($id);

            // Delete associated image if it exists
            if (File::exists(public_path($clothes->image))) {
                File::delete(public_path($clothes->image));
            }

            $clothes->delete();
            return response()->json([
                'success' => true,
                'message' => 'Clothes deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the clothes.'
            ], 500);
        }
    }
}
