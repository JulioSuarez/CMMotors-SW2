<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    use HasFactory;

    public $timestamps = false;
    // public $incrementing = false;

    protected $fillable = [
        'id',
        'cantidad',
        'precio',
        'id_producto',
        'id_cotizacion',
        'precio_producto_unitario',
        'tiempo_entrega',
        'detalle_co',
        'unidad_co',
    ];

    public function productos(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Producto::class, 'id_producto');
    }


    public function cotizacions(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Cotizacion::class);
    }
}
