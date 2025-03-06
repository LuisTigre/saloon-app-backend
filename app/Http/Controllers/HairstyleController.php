<?php

namespace App\Http\Controllers;

use App\Models\Hairstyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HairstyleController extends Controller
{
    public function index()
    {
        return response()->json(Hairstyle::with('images')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $hairstyle = Hairstyle::create($request->all());
        return response()->json($hairstyle, 201);
    }

    public function show(Hairstyle $hairstyle)
    {
        return response()->json($hairstyle);
    }


    public function update(Request $request, Hairstyle $hairstyle)
    {
        $request->validate([
            'style_name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
        ]);

        $hairstyle->update($request->all());
        return response()->json($hairstyle);
    }

    public function destroy(Hairstyle $hairstyle)
    {
        $hairstyle->delete();
        return response()->json(null, 204);
    }

    public function showDetails($braidingStyleId)
    {
        $query = "
        SELECT
            ap.id,
            bs.id AS hairstyle_id,
            bs.name AS style_name,
            bs.description,
            bs.duration,
            bs.price,
            i.image_url,
            sa.id AS attribute_id,
            sa.name AS attribute_name,
            sav.value AS attribute_value,
            ap.additional_cost,
            ap.cost_type
        FROM hairstyles bs
        LEFT JOIN attribute_pricings ap ON bs.id = ap.hairstyle_id
        LEFT JOIN hairstyle_attribute_values sav ON ap.hairstyle_attribute_value_id = sav.id
        LEFT JOIN hairstyle_attributes sa ON sav.hairstyle_attribute_id = sa.id
        LEFT JOIN hairstyle_images i ON bs.id = i.hairstyle_id
        WHERE bs.id = ?
    ";

        $results = DB::select($query, [$braidingStyleId]);
        
        if (empty($results)) {
            return response()->json(['message' => 'Braiding style not found'], 404);
        }
        
        $collection = collect($results);

        
        $imageUrls = $collection->pluck('image_url')->unique()->filter()->values()->toArray();
        
        $groupedAttributes = $collection->groupBy('attribute_name')->map(function ($attributes, $name) {
            // dd($attributes);
            return [
                'id'     => $attributes->first()->attribute_id,
                'name'   => $name,
                'values' => $attributes->map(function ($attribute) {
                    return [
                        'id'               => $attribute->id,
                        'name'             => $attribute->attribute_value,
                        'additional_cost'  => $attribute->additional_cost ?? 0.00,
                        'cost_type'        => $attribute->cost_type ?? 'fixed',
                    ];
                })->values()->toArray(),
            ];
        })->values()->toArray();
        
        $braidingStyle = [
            'id'              => $collection->first()->hairstyle_id,
            'name'            => $collection->first()->style_name,
            'description'     => $collection->first()->description,
            'imageUrl'        => $imageUrls,
            'stylesAttributes' => $groupedAttributes,
            'duration'        => $collection->first()->duration,
            'price'           => $collection->first()->price,
        ];

        return response()->json($braidingStyle);
    }
}
