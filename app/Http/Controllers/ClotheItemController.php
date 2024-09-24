<?php

namespace App\Http\Controllers;

use App\Models\clothe_items;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClotheItemController extends Controller
{
    /**
     * Store a newly created clothing item in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:20',
            'brand' => 'nullable|string|max:100',
            'material' => 'nullable|string|max:100',
            // 'purchase_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Create a new clothing item
        $clotheItem = clothe_items::create($validatedData);

        // Optionally, you can return a response or redirect
        return response()->json([
            'message' => 'Clothing item created successfully.',
            'clothe_item' => $clotheItem,
        ], 201);
    }


    public function destroy($id){
        $clotheItem = clothe_items::find($id);

        if(!$clotheItem) {
            return response()->json(['message' => 'Clothing item not found.'], Response::HTTP_NOT_FOUND);
        }

        $clotheItem->delete();

        return response()->json(['message' => 'Clothing item deleted successfully.'], Response::HTTP_OK);


    }

     public function index()
     {
        $clotheItems = clothe_items::all();

        // Return the clothing items in a JSON response
        return response()->json($clotheItems, Response::HTTP_OK);

    }

     public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'size' => 'sometimes|string|max:10',
            'color' => 'sometimes|string|max:50',
            'brand'=> 'sometimes|string|max:50'
            
        ]);

        $clotheItem = clothe_items::find($id);

        if (!$clotheItem) {
            return response()->json(['message' => 'Clothing item not found'], Response::HTTP_NOT_FOUND);
        }

        $clotheItem->update($validatedData);

        return response()->json($clotheItem, Response::HTTP_OK);
    }

    public function show($id)
    {
        $clotheItem = clothe_items::find($id);

        if (!$clotheItem) {
            return response()->json(['message' => 'Clothing item not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($clotheItem, Response::HTTP_OK);
    }
}