<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    function pedido(){
        return $this->HasMany(Pedido::class)->get();
    }

    function usuario(){
        return $this->belongsTo(USER::class, 'user_id', 'id');
    }
}
