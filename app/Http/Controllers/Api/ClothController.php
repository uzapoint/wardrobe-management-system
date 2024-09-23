<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClothingItem;
use App\Models\Drawer;
use App\Models\Wardrobe;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     // Get all the clothing items
    //     return \App\Models\ClothingItem::all();
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     // Show the form for creating a new clothing item
    //     // return view('clothing.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     // Create a new clothing item
    //     $clothingItem = \App\Models\ClothingItem::create($request->all());

    //     // Upload the image to the storage directory
    //     $imagePath = $request->file('image')->store('clothing_items');
    //     $clothingItem->update(['image' => $imagePath]);

    //     return $clothingItem;
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     // Get a specific clothing item
    //     return \App\Models\ClothingItem::find($id);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     // Get the clothing item for editing
    //     return \App\Models\ClothingItem::find($id);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     // Update the clothing item
    //     $clothingItem = \App\Models\ClothingItem::find($id);
    //     $clothingItem->update($request->all());

    //     // Upload the image to the storage directory (if provided)
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('clothing_items');
    //         $clothingItem->update(['image' => $imagePath]);
    //     }

    //     return $clothingItem;
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     // Delete the clothing item
    //     \App\Models\ClothingItem::destroy($id);

    //     return response()->noContent();
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clothingItems = ClothingItem::with(['wardrobe', 'drawer'])->get();
        return response()->json($clothingItems);
    }

    /**
     * Show the form for creating a new resource (not typically used in APIs).
     */
    public function create()
    {
        // For API, you might want to return wardrobes and drawers for the frontend to build a form
        $wardrobes = Wardrobe::all();
        $drawers = Drawer::all();
        return response()->json(['wardrobes' => $wardrobes, 'drawers' => $drawers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wardrobe_id' => 'required|exists:wardrobes,id',
            'drawer_id' => 'required|exists:drawers,id',
            'user_id' => 'required|exists:users,id',
            'clothing_name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'size' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        $clothingItem = ClothingItem::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Clothing item created successfully.',
            'data' => $clothingItem
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clothingItem = ClothingItem::with(['wardrobe', 'drawer'])->findOrFail($id);
        return response()->json($clothingItem);
    }

    /**
     * Show the form for editing the specified resource (not typically used in APIs).
     */
    public function edit(string $id)
    {
        // Similar to create, provide the item along with wardrobes and drawers
        $clothingItem = ClothingItem::findOrFail($id);
        $wardrobes = Wardrobe::all();
        $drawers = Drawer::all();

        return response()->json([
            'clothing_item' => $clothingItem,
            'wardrobes' => $wardrobes,
            'drawers' => $drawers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'wardrobe_id' => 'required|exists:wardrobes,id',
            'drawer_id' => 'required|exists:drawers,id',
            'clothing_name' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'size' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        $clothingItem = ClothingItem::findOrFail($id);
        $clothingItem->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Clothing item is not found.',
            'data' => $clothingItem
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clothingItem = ClothingItem::find($id);

        // check if the items exist
        if ($clothingItem) {

            // Check if the image exists and is not the default image
            if ($clothingItem->image) {
                unlink(storage_path('app/' . $clothingItem->image));
            }


            // Delete the clothing item itself
            $clothingItem->delete();

            return response()->json([
                'status' =>'success',
                'message' => 'Clothing item deleted successfully.'
            ]);
        }

        return response()->json([
            'status' => 'warning',
            'message' => 'Clothing item is not found.'
        ]);
    }
}
