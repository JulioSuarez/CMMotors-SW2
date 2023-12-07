<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    // public $timestamps = false;
    // public $incrementing = false; 

    protected $fillable = [
        'id',
        'nombre_proveedor',
        'proveedor_direccion',
        'proveedor_telefono',
        'proveedor_correo',
        'estado',
        'nombre_proveedor_contacto',
        'nit',
        'tipo'
    ];


    public function produtos(){
        //hasMany{tien mucho} //metodo para dar la primari key
    return $this->hasMany(Producto::class);
    }
}
