<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function proudctos(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Producto::class);
    }

  public function estantes(){
    //belongsTo{pertenece a} //metodo para recibir la foreing key
   return $this->belongsTo(Estante::class);
}
}

