<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'detalles',
        'cantidad',
        'precio',
        'id_producto',
        'id_venta',
        'precio_producto_unitario',
        'costo_producto',
        'unidad',
    ];
    
    public function productos(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Producto::class,'id_producto');
    }

    public function ventas(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Venta::class,'id_venta');
    }
}
