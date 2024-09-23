<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clothes;
Use Illuminate\Support\Facades\Auth;
class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get the list of clothes
       $clothes=Clothes::all();
        return view('clothes.index',compact('clothes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clothes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'size' => 'required',
            'image' => 'nullable'
        ]);
    
        $ImagePath = null;
    
    
        // Check if the image is there
        if ($request->hasFile('image')) {
            // Store the image file in the "public/uploads" folder
            $ImagePath = $request->file('image')->store('uploads','public');
        }
    
    
        // Create the SalvageItem record with file paths
        $clothe = Clothes::create([
            'name' => $request->name,
            'category' => $request->category,
            'size' => $request->size,
            'image' => $ImagePath,
            'user_id'=> Auth::id()
        ]);
    
        return redirect()->route('clothes.index')->with('success', 'New record added successfully');
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
    // Find the clothes item or fail
    $clothes = Clothes::findOrFail($id);
    return view('clothes.edit', compact('clothes'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required',
        'category' => 'required',
        'size' => 'required',
        'image' => 'nullable|image',
        'user_id'=> Auth::id()
        // Ensure image is a valid image file
    ]);

    // Find the existing Clothe item
    $clothe = Clothes::findOrFail($id);

    // Check if new image file is uploaded
    if ($request->hasFile('image')) {
        // Store the new image and get its path
        $ImagePath = $request->file('image')->store('uploads', 'public');

        // Update the image path in the database
        $clothe->image = $ImagePath;
    }

    // Update other fields
    $clothe->name = $request->name;
    $clothe->category = $request->category;
    $clothe->size = $request->size;

    // Save the updated record
    $clothe->save();

    // Redirect the user with a success message
    return redirect()->route('clothes.edit',$clothe->id)->with('success', 'Record updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            // Find the clothe with the given ID

            $clothes= Clothes::findOrFail($id);

            // Delete the clothe
            $clothes->delete();


            // Redirect back to the provider index page with a success message
            return redirect()->route('clothes.index')->with('success', 'Record deleted successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }
    }
    
}
