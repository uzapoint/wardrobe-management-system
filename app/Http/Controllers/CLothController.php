<?php

namespace App\Http\Controllers;

use App\Models\Cloth;
use Illuminate\Http\Request;

class CLothController extends Controller
{
    public function index()
    {
        $clothes = Cloth::all();
        return view("wardrobe.index", compact("clothes"));

    }

    public function create()
    {
        return view('wardrobe.create');

    }

    public function show($id)
    {
        $cloth = Cloth::findOrFail( $id );

        return view('wardrobe.show', compact('cloth'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'cloth_name' => ['required'],
            'category' => ['required'],
            'color' => ['required'],
            'size' => ['required'],
            'image' => ['required', 'mimes:png,jpg,webp'],
        ]);
    
        //initialise the image
        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->image->store('images', 'public');
        }
    
        // Check if image upload was successful
        if (!$imagePath) {
            return back()->withErrors(['image' => 'Image upload failed.']);
        }
    
        
        $newCloth = Cloth::create([
            'cloth_name' => $data['cloth_name'],
            'category' => $data['category'],
            'color' => $data['color'],
            'size' => $data['size'],
            'image' => $imagePath,
        ]);
    
        
        return redirect(route('clothes.index'))->with('success', 'Cloth added successfully.');

    }

    public function update(Request $request, $id)
    {
        
        $cloth = Cloth::findOrFail($id);


        $data = $request->validate([
        'cloth_name' => ['required'],
        'category' => ['required'],
        'color' => ['required'],
        'size' => ['required'],
        'image'=> ['required', 'mimes:png,jpg,webp'],
    ]);


        if ($request->hasFile('image')) {
        $imagePath = $request->image->store('images', 'public');
        $data['image'] = $imagePath;
    }


        $cloth->update($data);

        return redirect(route('clothes.index'));
    }

    public function edit($id)
    {
        $data = Cloth::findOrFail($id);
        return view('wardrobe.edit', compact('data'));

    }

    public function destroy($id)
    {
        $data = Cloth::findOrFail($id);
        $data->delete();
        return redirect(route('clothes.index'));

    }


}

 