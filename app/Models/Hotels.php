<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location_id', 'price', 'image', 'rating', 'facilities'
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }
}

