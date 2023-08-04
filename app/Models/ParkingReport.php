<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'vehiclename',
        'start_location',
        'end_location',
        'start_time',
        'end_time',
        'duration',
        'created_at',
    ];
}
