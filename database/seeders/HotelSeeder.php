<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotels;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotels::create([
            'hotel_name'  => 'The Ritz-Carlton Jakarta',
            'description' => 'Located in the dynamic Sudirman Central Business District...',
            'location'    => 'Jakarta',
            'price'       => 'Rp. 8.000.000',
            'image'       => '/assets/img/ritz-carlton.jpg',
            'rating'      => 4.9,
        ]);
    }
}
