<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Menampilkan semua lokasi
    public function index()
    {
        $locations = Location::with('hotels')->get();
        return response()->json($locations);
    }

    // Menyimpan lokasi baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Location created successfully.',
            'data' => $location
        ], 201);
    }

    // Menampilkan satu lokasi
    public function show($id)
    {
        $location = Location::with('hotels')->findOrFail($id);

        return response()->json($location);
    }

    // Mengupdate data lokasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location = Location::findOrFail($id);
        $location->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Location updated successfully.',
            'data' => $location
        ]);
    }

    // Menghapus lokasi
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json([
            'message' => 'Location deleted successfully.'
        ]);
    }
}
