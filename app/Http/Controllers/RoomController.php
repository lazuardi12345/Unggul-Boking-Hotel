<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // GET /api/rooms
    public function index()
    {
        $rooms = Room::with('hotel')->get();

        return response()->json([
            'success' => true,
            'data' => $rooms
        ], 200);
    }

    // POST /api/rooms
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'  => 'required|exists:hotels,id',
            'type'      => 'required|string|max:255',
            'count'     => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
            'occupied'  => 'required|integer|min:0',
        ]);

        $room = Room::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil ditambahkan.',
            'data' => $room
        ], 201);
    }

    // GET /api/rooms/{id}
    public function show(Room $room)
    {
        $room->load('hotel');

        return response()->json([
            'success' => true,
            'data' => $room
        ], 200);
    }

    // PUT /api/rooms/{id}
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'hotel_id'  => 'required|exists:hotels,id',
            'type'      => 'required|string|max:255',
            'count'     => 'required|integer|min:0',
            'available' => 'required|integer|min:0',
            'occupied'  => 'required|integer|min:0',
        ]);

        $room->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil diperbarui.',
            'data' => $room
        ], 200);
    }

    // DELETE /api/rooms/{id}
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room berhasil dihapus.'
        ], 200);
    }
}
