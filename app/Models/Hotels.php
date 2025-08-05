<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
     protected $fillable = [
        'hotel_name',
        'description',
        'location',
        'price',
        'hotel_image',
        'rating',
     ];
}
