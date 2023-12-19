<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_membresia extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'precio',
    ];

    public function membresia()
    {
        //belongsTo{pertenece a} //metodo para recibir la foreing key
        return $this->belongsTo(Membresia::class);
    }

    public function venta()
    {
        //belongsTo{pertenece a} //metodo para recibir la foreing key
        return $this->belongsTo(Venta::class);
    }

}
