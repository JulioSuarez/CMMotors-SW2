<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosGeneral extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function ventas(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Venta::class);
    }

    public function cotizacions(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Cotizacion::class);
    }
}
