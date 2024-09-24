<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClothingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ClothingItemController extends Controller
{
    public function index() {
        return ClothingItem::with('category:id,name')->get();
    }

    public function show($id) {
        return ClothingItem::findOrFail($id);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|string|max:50',
            'color' => 'required|string|max:50',
            'material' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Add the logged-in user's ID to the data
        $validatedData['user_id'] = Auth::id(); // or auth()->id()

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/clothing', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Save the clothing item
        return ClothingItem::create($validatedData);
    }

    public function update(Request $request, $id) {
        $clothingItem = ClothingItem::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'size' => 'string|max:50',
            'color' => 'string|max:50',
            'material' => 'string|max:255',
            'category_id' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($clothingItem->image) {
                Storage::disk('public')->delete($clothingItem->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('images/clothing', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Set the user_id to the logged-in user's ID
        $validatedData['user_id'] = Auth::id(); // or auth()->id()

        $clothingItem->update($validatedData);

        return $clothingItem;
    }

    public function destroy($id) {
        $clothingItem = ClothingItem::findOrFail($id);

        // Delete image if exists
        if ($clothingItem->image) {
            Storage::disk('public')->delete($clothingItem->image);
        }

        $clothingItem->delete();

        return response()->json(['message' => 'Clothing item deleted successfully']);
    }
}
