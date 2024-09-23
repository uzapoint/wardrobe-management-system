<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cloth;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all clothes

        $clothes = Cloth::all();

        return response()->json($clothes);


    }

    /**
     * add a new cloth to the wardrobe.
     */
    public function create()
    {
        //create a new cloth

        $cloth = Cloth::create($request->all());

        return response()->json($cloth);

    }



    /**
     * Update an existing cloth in the wardrobe .
     */
    public function update(Request $request, string $id)
    {
        //update a cloth

        $cloth = Cloth::find($id);

        $cloth->update($request->all());

        return response()->json($cloth);
    }

    /**
     * Remove the specified cloth from the wardrobe.
     */
    public function destroy(string $id)
    {
      
        $cloth = Cloth::findOrFail($cloth);

        $cloth->delete();

        return $this->successResponse($cloth);

    }
}


