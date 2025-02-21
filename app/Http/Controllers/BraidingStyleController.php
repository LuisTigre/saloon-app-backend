<?php

namespace App\Http\Controllers;

use App\Models\BraidingStyle;
use Illuminate\Http\Request;

class BraidingStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $styles = BraidingStyle::all();
        return response()->json($styles);
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
            'style_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $style = BraidingStyle::create($validated);
        return response()->json($style, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BraidingStyle $braidingStyle)
    {       
        return response()->json($braidingStyle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BraidingStyle $braidingStyle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BraidingStyle $braidingStyle)
    {
        $validated = $request->validate([
            'style_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $braidingStyle->update($validated);
        return response()->json($braidingStyle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BraidingStyle $braidingStyle)
    {
        $braidingStyle->delete();
        return response()->json(null, 204);
    }
}
