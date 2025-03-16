<?php

namespace App\Http\Controllers;

use App\Models\HairstyleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HairstyleImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = HairstyleImage::all();
        return response()->json($images);
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
        $request->validate([
            'hairstyle_id' => 'required|exists:hairstyles,id',
            'image' => 'required|image|max:2048', // Validate image file
            'is_main_image' => 'required|boolean',
        ]);
    
        // If the new record's is_main_image is 1, update existing main images to 0
        if ($request->is_main_image == 1) {
            HairstyleImage::where('hairstyle_id', $request->hairstyle_id)
                          ->where('is_main_image', 1)
                          ->update(['is_main_image' => 0]);
        }
    
        // Store the uploaded image file
        $path = $request->file('image')->store('hairstyle_images', 'public');
        
        // Create the image record in the database
        $image = HairstyleImage::create([
            'hairstyle_id' => $request->hairstyle_id,
            'image_url' => Storage::url($path),
            'is_main_image' => $request->is_main_image,
        ]);
        
        
        return response()->json($image, 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $image = HairstyleImage::findOrFail($id);
        return response()->json($image);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'hairstyle_id' => 'sometimes|exists:hairstyles,id',
            'image' => 'sometimes|image|max:2048', // Validate image file
            'is_main_image' => 'sometimes|boolean',
        ]);

        $image = HairstyleImage::findOrFail($id);

        // If a new image file is uploaded, store it and update the image_url
        if ($request->hasFile('image')) {
            // Delete the old image file
            Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_url));

            // Store the new image file
            $path = $request->file('image')->store('hairstyle_images', 'public');
            $image->image_url = Storage::url($path);
        }

        // Update other fields
        $image->update($request->except('image'));

        return response()->json($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = HairstyleImage::findOrFail($id);

        // Delete the image file
        Storage::disk('public')->delete(str_replace('/storage/', '', $image->image_url));

        // Delete the record from the database
        $image->delete();

        return response()->json(null, 204);
    }
}
