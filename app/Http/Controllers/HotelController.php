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
}
