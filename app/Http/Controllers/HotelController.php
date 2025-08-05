<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    // GET /api/hotels
    public function index()
    {
        $hotels = Hotel::with('location')->get();

        foreach ($hotels as $hotel) {
            $hotel->image_url = url('hotels/' . basename($hotel->image));
        }

        return response()->json([
            'success' => true,
            'data' => $hotels
        ], 200);
    }

    // POST /api/hotels
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'location_id'  => 'required|exists:locations,id',
            'price'        => 'required|numeric',
            'image'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rating'       => 'required|numeric|between:0,5',
            'facilities'   => 'required|array',
        ]);

        $imagePath = $request->file('image')->store('hotels', 'public');

        $hotel = Hotel::create([
            'name'         => $request->name,
            'location_id'  => $request->location_id,
            'price'        => $request->price,
            'image'        => $imagePath,
            'rating'       => $request->rating,
            'facilities'   => $request->facilities,
        ]);

        $hotel->image_url = url('hotels/' . basename($hotel->image));

        return response()->json([
            'success' => true,
            'message' => 'Hotel berhasil ditambahkan.',
            'data' => $hotel
        ], 201);
    }

    // GET /api/hotels/{id}
    public function show(Hotel $hotel)
    {
        $hotel->load('location', 'rooms', 'roomImages');
        $hotel->image_url = url('hotels/' . basename($hotel->image));

        return response()->json([
            'success' => true,
            'data' => $hotel
        ], 200);
    }

    // PUT /api/hotels/{id}
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'location_id'  => 'required|exists:locations,id',
            'price'        => 'required|numeric',
            'rating'       => 'required|numeric|between:0,5',
            'facilities'   => 'required|array',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
                Storage::disk('public')->delete($hotel->image);
            }

            $hotel->image = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update([
            'name'         => $request->name,
            'location_id'  => $request->location_id,
            'price'        => $request->price,
            'rating'       => $request->rating,
            'facilities'   => $request->facilities,
            'image'        => $hotel->image,
        ]);

        $hotel->image_url = url('hotels/' . basename($hotel->image));

        return response()->json([
            'success' => true,
            'message' => 'Hotel berhasil diperbarui.',
            'data' => $hotel
        ], 200);
    }

    // DELETE /api/hotels/{id}
    public function destroy(Hotel $hotel)
    {
        if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
            Storage::disk('public')->delete($hotel->image);
        }

        $hotel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hotel berhasil dihapus.'
        ], 200);
    }
}
