<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use Illuminate\Http\Request;

class OutfitController extends Controller
{
    // Get all outfits
    public function index()
    {
        $outfits = Outfit::with('user')->get();
        return response()->json($outfits);
    }

    // Store a new outfit
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $outfit = Outfit::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return response()->json($outfit, 201);
    }

    // Get a single outfit
    public function show($id)
    {
        $outfit = Outfit::with('user')->find($id);

        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }

        return response()->json($outfit);
    }

    // Update an outfit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $outfit = Outfit::find($id);

        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }

        $outfit->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return response()->json($outfit);
    }

    // Delete an outfit
    public function destroy($id)
    {
        $outfit = Outfit::find($id);

        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }

        $outfit->delete();
        return response()->json(['message' => 'Outfit deleted successfully']);
    }
}
