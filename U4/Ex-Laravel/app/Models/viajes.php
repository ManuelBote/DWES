<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viajes extends Model
{
    use HasFactory;

    function reservas(){
        return $this->hasMany(reserva::class)->get();
    }
}
