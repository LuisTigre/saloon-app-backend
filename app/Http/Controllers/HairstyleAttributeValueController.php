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
            'hairstyle_attribute_id' => 'required|exists:hairstyle_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        $attributeValue = HairstyleAttributeValue::create($request->all());
        return response()->json($attributeValue, 201);
    }

    public function show($id)
    {
        $attributeValue = HairstyleAttributeValue::findOrFail($id);
        return response()->json($attributeValue);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hairstyle_attribute_id' => 'sometimes|exists:hairstyle_attributes,id',
            'value' => 'sometimes|string|max:255',
        ]);

        $attributeValue = HairstyleAttributeValue::findOrFail($id);
        $attributeValue->update($request->all());
        return response()->json($attributeValue);
    }

    public function destroy($id)
    {
        $attributeValue = HairstyleAttributeValue::findOrFail($id);
        $attributeValue->delete();
        return response()->json(null, 204);
    }
}
