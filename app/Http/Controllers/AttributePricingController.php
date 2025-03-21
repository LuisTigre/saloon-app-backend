<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttributePricing;

class AttributePricingController extends Controller
{
    // Get all attribute pricings
    public function index()
    {
        return response()->json(AttributePricing::all());
    }

    // Store a new attribute pricing
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hairstyle_id' => 'required|exists:hairstyles,id',
            'hairstyle_attribute_value_id' => 'required|exists:hairstyle_attribute_values,id',
            'hairstyle_image_id' => 'nullable|exists:hairstyle_images,id', // Add validation for hairstyle_image_id
            'additional_cost' => 'nullable|numeric|min:0',
            'additional_time' => 'nullable|numeric|min:0',
            'cost_type' => 'nullable|in:fixed,percentage',
        ]);

        $attributePricing = AttributePricing::create($validated);

        return response()->json($attributePricing, 201);
    }

    // Show a specific attribute pricing
    public function show($id)
    {
        $attributePricing = AttributePricing::findOrFail($id);
        return response()->json($attributePricing);
    }

    // Update an attribute pricing
    public function update(Request $request, $id)
    {
        $attributePricing = AttributePricing::findOrFail($id);

        $validated = $request->validate([
            'hairstyle_image_id' => 'sometimes|exists:hairstyle_images,id', // Add validation for hairstyle_image_id
            'additional_cost' => 'sometimes|numeric|min:0',
            'additional_time' => 'sometimes|numeric|min:0',
            'cost_type' => 'sometimes|in:fixed,percentage',
        ]);

        $attributePricing->update($validated);

        return response()->json($attributePricing);
    }

    // Delete an attribute pricing
    public function destroy($id)
    {
        $attributePricing = AttributePricing::findOrFail($id);
        $attributePricing->delete();

        return response()->json(['message' => 'Attribute pricing deleted successfully']);
    }
}
