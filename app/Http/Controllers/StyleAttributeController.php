<?php

namespace App\Http\Controllers;

use App\Models\StyleAttribute;
use Illuminate\Http\Request;

class StyleAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = StyleAttribute::all();
        return response()->json($attributes);
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
            'attribute_name' => 'required|string|max:255',
        ]);

        $attribute = StyleAttribute::create($validated);
        return response()->json($attribute, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StyleAttribute $styleAttribute)
    {
        return response()->json($styleAttribute);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StyleAttribute $styleAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StyleAttribute $styleAttribute)
    {
        $validated = $request->validate([
            'attribute_name' => 'required|string|max:255',
        ]);

        $styleAttribute->update($validated);
        return response()->json($styleAttribute);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StyleAttribute $styleAttribute)
    {
        $styleAttribute->delete();
        return response()->json(null, 204);
    }
}
