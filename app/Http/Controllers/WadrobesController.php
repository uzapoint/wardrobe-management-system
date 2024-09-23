<?php

namespace App\Http\Controllers;

use App\Models\Wadrobes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\WadrobeResource;

class WadrobesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $req)
    {

        $user_id = $req->user_id;
        $wadrobes = Wadrobes::where('user_id', $user_id)->paginate(10) ?? null;

        return WadrobeResource::collection($wadrobes);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate(['description' => 'required|string']);
        return Wadrobes::create($request->all());
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
    public function update(Request $request, Wadrobes $wadrobe)
    {
        $wadrobe->update($request->all());
        return $wadrobe;
    }

    public function destroy(Wadrobes $wadrobe)
    {
        $wadrobe->delete();
        return response()->noContent();
    }
}
