<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'required|string|max:255',
            ]);

            Category::create($validated);
            return response()->json(['success' => true, 'message' => 'Category added successfully'], 201);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error adding item: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);
        return response()->json(['success' => true,'message' => 'Category updated successfully']);
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true,'message' => 'Category deleted successfully']);
    }
}
