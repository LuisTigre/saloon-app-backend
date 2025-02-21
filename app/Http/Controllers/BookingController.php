<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('attributeValues')->get();
        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id'      => 'required|exists:users,id',
            'style_id'         => 'required|exists:braiding_styles,id',
            'appointment_date' => 'required|date',
            'start_time'       => 'required|date_format:H:i',
            'end_time'         => 'required|date_format:H:i|after:start_time',
            'total_price'      => 'required|numeric',
            'status'           => 'required|in:Pending,Confirmed,Completed,Canceled',
            // Optionally accept an array of style attribute value IDs
            'attribute_values'      => 'sometimes|array',
            'attribute_values.*'    => 'exists:style_attribute_values,id',
        ]);

        $booking = Booking::create($validated);

        if ($request->has('attribute_values')) {
            $booking->attributeValues()->sync($request->input('attribute_values'));
        }

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('attributeValues');
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id'      => 'required|exists:users,id',
            'style_id'         => 'required|exists:braiding_styles,id',
            'appointment_date' => 'required|date',
            'start_time'       => 'required|date_format:H:i',
            'end_time'         => 'required|date_format:H:i|after:start_time',
            'total_price'      => 'required|numeric',
            'status'           => 'required|in:Pending,Confirmed,Completed,Canceled',
            'attribute_values' => 'sometimes|array',
            'attribute_values.*' => 'exists:style_attribute_values,id',
        ]);

        $booking->update($validated);

        if ($request->has('attribute_values')) {
            $booking->attributeValues()->sync($request->input('attribute_values'));
        }

        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}
