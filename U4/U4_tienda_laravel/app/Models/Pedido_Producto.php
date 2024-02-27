<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_Producto extends Model
{
    use HasFactory;
   protected $table = 'pedido_productos';

    function pedido(){
        //Si seguimos la convencion de nombres
        return $this->belongsTo(Pedido::class);
    }

    function producto(){
        //Si NO seguimos la convencion de nombres
        return $this->belongsTo(Producto::class, 'producto', 'id');
    }
}
