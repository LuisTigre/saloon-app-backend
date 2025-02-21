<?php

namespace App\Http\Controllers;

use App\Models\StyleAttributeValue;
use Illuminate\Http\Request;

class StyleAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributeValues = StyleAttributeValue::all();
        return response()->json($attributeValues);
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
            'attribute_id' => 'required|exists:style_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        $attributeValue = StyleAttributeValue::create($validated);
        return response()->json($attributeValue, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(StyleAttributeValue $styleAttributeValue)
    {
        return response()->json($styleAttributeValue);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StyleAttributeValue $styleAttributeValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StyleAttributeValue $styleAttributeValue)
    {
        $validated = $request->validate([
            'style_id' => 'required|exists:braiding_styles,id',
            'attribute_id' => 'required|exists:style_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        $styleAttributeValue->update($validated);
        return response()->json($styleAttributeValue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StyleAttributeValue $styleAttributeValue)
    {
        $styleAttributeValue->delete();
        return response()->json(null, 204);
    }
}
