<?php

namespace App\Http\Controllers;

use App\Models\Hotels;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotels::all(); // ambil semua hotel dari database
        return view('home', compact('hotels'));
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'hotel_name'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'description'  => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'phone'        => 'nullable|string|max:20',
            'hotel_image'  => 'required|image|mimes:jpg,jpeg,png,gif|max:5120', // max 5MB
        ]);

        // Proses upload gambar
        if ($request->hasFile('hotel_image')) {
            $image      = $request->file('hotel_image');
            $fileName   = time() . '_' . Str::slug($request->hotel_name) . '.' . $image->getClientOriginalExtension();
            $imagePath  = $image->storeAs('public/hotel_images', $fileName);
        }

        // Simpan data ke database
        Hotel::create([
            'hotel_name'   => $validated['hotel_name'],
            'location'     => $validated['location'],
            'description'  => $validated['description'],
            'rating'       => $validated['rating'],
            'phone'        => $validated['phone'],
            'hotel_image'  => $fileName ?? null
        ]);

        return redirect()->back()->with('success', 'Hotel berhasil ditambahkan!');
    }
}
