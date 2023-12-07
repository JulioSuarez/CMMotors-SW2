<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // public $timestamps = false;

    protected $fillable = [
        'id',
        'cod_producto',
        'cod_oem',
        'nombre',
        'marca',
        'procedencia',
        'origen',
        'cantidad',
        'cant_minima',
        'precio_venta_con_factura',
        'precio_venta_sin_factura',
        'precio_compra',
        'foto',
        'tienda',
        'unidad',
        'estado',
        'estante',
        'id_tugerente',
        'id_proveedor'
    ];


    // public function ubicaciones(){
    //     //belongsTo{pertenece a} //metodo para recibir la foreing key
    // return $this->belongsTo(Ubicacion::class);
    // }


    public function proveedores()
    {
        //belongsTo{pertenece a} //metodo para recibir la foreing key
        return $this->belongsTo(Proveedor::class);
    }

    public function detallesCotizaciones()
    {
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(DetalleCotizacion::class, 'id_producto');
    }

    public function detallesVentas()
    {
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }
}
