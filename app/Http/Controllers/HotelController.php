<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Hotels;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    // GET /api/hotels
    public function index()
    {
        return view('agents.agent_dashboard'); 
    }

    public function getAllData()
    {
        // Ambil data dummy dari file PHP
        $hotels = include(base_path('database/hotels_dummy.php'));

        // Ambil nama-nama hotel untuk label grafik
        $hotel_labels = array_map(fn($h) => $h['name'], $hotels);

        // Hitung jumlah kamar total, tersedia, dan dipakai per hotel
        $hotel_room_counts = [];
        $hotel_available_counts = [];
        $hotel_occupied_counts = [];

        foreach ($hotels as $hotel) {
            $room_total = 0;
            $room_available = 0;
            $room_occupied = 0;

            if (isset($hotel['rooms']) && is_array($hotel['rooms'])) {
                foreach ($hotel['rooms'] as $room) {
                    $room_total += $room['count'];
                    // Simulasi: 60% tersedia, 40% terpakai
                    $room_available += round($room['count'] * 0.6);
                    $room_occupied += round($room['count'] * 0.4);
                }
            }

            $hotel_room_counts[] = $room_total;
            $hotel_available_counts[] = $room_available;
            $hotel_occupied_counts[] = $room_occupied;
        }

        // Hitung total tersedia dan dipakai
        $total_available = array_sum($hotel_available_counts);
        $total_occupied = array_sum($hotel_occupied_counts);

        return view('admin.admin_properties', compact(
            'hotels',
            'hotel_labels',
            'hotel_room_counts',
            'hotel_available_counts',
            'hotel_occupied_counts',
            'total_available',
            'total_occupied'
        ));
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

        $hotel = Hotels::create([
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
    public function show(Hotels $hotel)
    {
        $hotel->load('location', 'rooms', 'roomImages');
        $hotel->image_url = url('hotels/' . basename($hotel->image));

        return response()->json([
            'success' => true,
            'data' => $hotel
        ], 200);
    }

    // PUT /api/hotels/{id}
    public function update(Request $request, Hotels $hotel)
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
    public function destroy(Hotels $hotel)
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
