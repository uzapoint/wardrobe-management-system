<?php

namespace App\Http\Controllers;

use App\Http\Resources\WadrobeCategoryResource;
use App\Models\WadrobeClothingCategory;
use Illuminate\Http\Request;

class WadrobesCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $wadrobe_id = $req->wadrobe_id;
        $wadrobes = WadrobeClothingCategory::where('wadrobe_id', $wadrobe_id)->paginate(10) ?? null;

        return WadrobeCategoryResource::collection($wadrobes);
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
        $request->validate(['description' => 'required|string', 'wadrobe_id' => 'required']);
        return WadrobeClothingCategory::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, WadrobeClothingCategory $wadrobe)
    {
        $wadrobe->update($request->all());
        return $wadrobe;
    }

    public function destroy(WadrobeClothingCategory $wadrobe)
    {
        $wadrobe->delete();
        return response()->noContent();
    }
}
