<?php

namespace App\Http\Controllers;

use App\Models\HairstyleAttributeValue;
use Illuminate\Http\Request;

class HairstyleAttributeValueController extends Controller
{
    public function index()
    {
        return response()->json(HairstyleAttributeValue::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'hairstyle_attribute_id' => 'required',
            'value' => 'required|string|max:255',
        ]);

        $attributeValue = HairstyleAttributeValue::create($request->all());
        return response()->json($attributeValue, 201);
    }

    public function show(HairstyleAttributeValue $hairstyleAttributeValue)
    {
        return response()->json($hairstyleAttributeValue);
    }

    public function update(Request $request, HairstyleAttributeValue $hairstyleAttributeValue)
    {
        $request->validate([
            'hairstyle_attribute_id' => 'sometimes|exists:hairstyle_attributes,id',
            'value' => 'sometimes|string|max:255',
        ]);

        $hairstyleAttributeValue->update($request->all());
        return response()->json($hairstyleAttributeValue);
    }

    public function destroy(HairstyleAttributeValue $hairstyleAttributeValue)
    {
        $hairstyleAttributeValue->delete();
        return response()->json(null, 204);
    }
}
