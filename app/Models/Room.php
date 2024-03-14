<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function accommondation()
    {
        return $this->belongsTo(Accommondation::class);
    }

    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetail::class);
    }
}
