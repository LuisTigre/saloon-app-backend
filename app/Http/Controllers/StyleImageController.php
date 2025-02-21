<?php

namespace App\Http\Controllers;

use App\Models\StyleImage;
use Illuminate\Http\Request;

class StyleImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = StyleImage::all();
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
        $validated = $request->validate([
            'style_id' => 'required|exists:braiding_styles,id',
            'image_url' => 'required|url',
            'is_main_image' => 'required|boolean',
        ]);

        $image = StyleImage::create($validated);
        return response()->json($image, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StyleImage $styleImage)
    {
        return response()->json($styleImage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StyleImage $styleImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StyleImage $styleImage)
    {
        $validated = $request->validate([
            'style_id' => 'required|exists:braiding_styles,id',
            'image_url' => 'required|url',
            'is_main_image' => 'required|boolean',
        ]);

        $styleImage->update($validated);
        return response()->json($styleImage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StyleImage $styleImage)
    {
        $styleImage->delete();
        return response()->json(null, 204);
    }
}
