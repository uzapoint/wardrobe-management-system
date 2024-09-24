<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClothingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClothingItemController extends Controller
{
    public function index() {
        return ClothingItem::all();
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
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/clothing', 'public');
            $validatedData['image'] = $imagePath;
        }

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
            'user_id' => 'exists:users,id',
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
