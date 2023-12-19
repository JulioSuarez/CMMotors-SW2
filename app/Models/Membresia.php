<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'estado',
    ];

    public function detalle_membresia()
    {
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(detalle_membresia::class);
    }


}
