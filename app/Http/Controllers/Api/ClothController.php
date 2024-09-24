<?php

// app/Http/Controllers/Api/ClothController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    public function index()
    {
        return Cloth::where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $cloth = Cloth::create(array_merge($request->all(), ['user_id' => auth()->id()]));
        return response()->json($cloth, 201);
    }

    public function show(Cloth $cloth)
    {
        return $cloth;
    }

    public function update(Request $request, Cloth $cloth)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $cloth->update($request->all());
        return response()->json($cloth, 200);
    }

    public function destroy(Cloth $cloth)
    {
        $cloth->delete();
        return response()->json(null, 204);
    }
}
