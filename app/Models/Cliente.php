<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'ci',
        'nombre',
        'empresa',
        'nit',
        'correo',
        'telefono',
        'direccion',
        'id_cliente',
    ];



    protected $primaryKey = 'ci';
    // public $timestamps = false;

    public function cotizaciones(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Cotizacion::class);
    }

    public function ventas(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Venta::class);
    }


}
