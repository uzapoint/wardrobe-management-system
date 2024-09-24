<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Models\ClothingItem;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class ClothingItemController extends Controller
{
    public function index(Request $request)
    {
        $clothingItems = ClothingItem::with(['category', 'colors', 'images', 'size'])->where('user_id',$request->id)->get();
        return response()->json($clothingItems);
    }


    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'size_id' => 'required|exists:sizes,id',
                'colors' => 'nullable|array',
                'colors.*' => 'exists:colors,id',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            DB::beginTransaction();

            $clothingItem = ClothingItem::create([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'size_id' => $validated['size_id'],
                'user_id' => $request->user()->id,
            ]);

            if ($request->has('colors')) {
                $clothingItem->colors()->attach($validated['colors']);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('clothing_images', 'public');
                    $clothingItem->images()->create(['image_path' => $imagePath]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Item added successfully'], 201);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error adding item: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, ClothingItem $clothingItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $clothingItem->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'size_id' => $validated['size_id'],
        ]);

        // Sync colors
        if ($request->has('colors')) {
            $clothingItem->colors()->sync($validated['colors']);
        }

        // Add images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('clothing_images', 'public');
                $clothingItem->images()->create(['image_path' => $imagePath]);
            }
        }

        return response()->json(['success'=>true, 'message'=>'Item update successfully'],200);
    }

    // Delete a clothing item
    public function destroy(ClothingItem $clothingItem)
    {
        foreach ($clothingItem->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $clothingItem->delete();
        return response()->json(['message' => 'Clothing item deleted successfully']);
    }
}
