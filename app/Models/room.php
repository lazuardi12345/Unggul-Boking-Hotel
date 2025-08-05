<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'hotel_id',
        'type',
        'count',
        'available',
        'occupied',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
