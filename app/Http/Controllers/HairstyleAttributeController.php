<?php

namespace App\Http\Controllers;

use App\Models\HairstyleAttribute;
use Illuminate\Http\Request;

class HairstyleAttributeController extends Controller
{
    public function index()
    {
        return response()->json(HairstyleAttribute::with('values')->get());
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

    public function show($id)
    {
        $attribute = HairstyleAttribute::findOrFail($id);
        return response()->json($attribute);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string',
        ]);

        $attribute = HairstyleAttribute::findOrFail($id);
        $attribute->update($request->all());
        return response()->json($attribute);
    }
   

    public function destroy($id)
    {
        $attribute = HairstyleAttribute::findOrFail($id);
        $attribute->delete();
        return response()->json(null, 204);
    }
}
