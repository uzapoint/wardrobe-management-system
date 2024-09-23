<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClothingResource;
use App\Http\Resources\WadrobeResource;
use App\Models\WadrobeClothing;
use App\Models\WadrobeClothingCategory;
use App\Models\Wadrobes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClothingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $req)
    {
        Log::info($req->all());
        $category_id = $req->user_id;
        $clothing = WadrobeClothing::where('wadrobe_clothing_category_id', $category_id)->paginate(10) ?? null;

        return ClothingResource::collection($clothing);
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
