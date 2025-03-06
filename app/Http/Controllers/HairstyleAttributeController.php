<?php

namespace App\Http\Controllers;

use App\Models\HairstyleAttribute;
use Illuminate\Http\Request;

class HairstyleAttributeController extends Controller
{
    public function index()
    {
        return response()->json(HairstyleAttribute::all());
    }

    public function getHairstyleAttributesValue(Request $request, $attribute_id)
    {   
        $attribute = HairstyleAttribute::find($attribute_id);
        return response()->json($attribute->values()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string',
        ]);

        $attribute = HairstyleAttribute::create($request->all());
        return response()->json($attribute, 201);
    }

    public function show(HairstyleAttribute $attribute)
    {
        return response()->json($attribute);
    }

    public function update(Request $request, HairstyleAttribute $attribute)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'nullable|string',
        ]);

        $attribute->update($request->all());
        return response()->json($attribute);
    }

    public function destroy(HairstyleAttribute $attribute)
    {
        $attribute->delete();
        return response()->json(null, 204);
    }
}
