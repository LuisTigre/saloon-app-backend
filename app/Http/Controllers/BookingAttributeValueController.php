<?php

namespace App\Http\Controllers;

use App\Models\BookingAttributeValue;
use Illuminate\Http\Request;

class BookingAttributeValueController extends Controller
{
    public function index()
    {
        return response()->json(BookingAttributeValue::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'hairstyle_attribute_value_id' => 'required|exists:hairstyle_attribute_values,id',
        ]);

        $bookingAttributeValue = BookingAttributeValue::create($request->all());
        return response()->json($bookingAttributeValue, 201);
    }

    public function show(BookingAttributeValue $bookingAttributeValue)
    {
        return response()->json($bookingAttributeValue);
    }

    public function update(Request $request, BookingAttributeValue $bookingAttributeValue)
    {
        $request->validate([
            'booking_id' => 'sometimes|exists:bookings,id',
            'hairstyle_attribute_value_id' => 'sometimes|exists:hairstyle_attribute_values,id',
        ]);

        $bookingAttributeValue->update($request->all());
        return response()->json($bookingAttributeValue);
    }

    public function destroy(BookingAttributeValue $bookingAttributeValue)
    {
        $bookingAttributeValue->delete();
        return response()->json(null, 204);
    }
}
