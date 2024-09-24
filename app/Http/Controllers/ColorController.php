<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return response()->json($colors);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name',
        ]);
            Color::create($validated);
        return response()->json(['success' => true,'message' => 'Color added successfully'], 201);
    }

    public function show(Color $color)
    {
        return response()->json($color);
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:colors,name,' . $color->id,
        ]);

        $color->update($validated);
        return response()->json(['success' => true,'message' => 'Color updated successfully'],200);
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json(['success' => true,'message' => 'Color deleted successfully']);
    }
}
