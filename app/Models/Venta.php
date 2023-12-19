<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'monto_total',
        'fecha' ,
        'hora',
        'descuento',
        'total_en_bolivianos',
        'total_en_dolares',
        'ci_cliente',
        'ci_empleado',
        'id_datos_generales',
        'id_venta',
        'nro_factura'
    ];


    public function clientes(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Cliente::class);
    }
    public function emepleados(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(Empleado::class);
    }

    public function detalles(){
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(DetalleVentas::class,'id_venta');
    }

    public function datos_generals(){
        //belongsTo{pertenece a} //metodo para recibir la foreing key
    return $this->belongsTo(DatosGeneral::class);
    }

    public function pagos(){
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(Pago::class,'id_venta');
    }

    public function detalle_membresia(){
        //hasMany{tien mucho} //metodo para dar la primari key
        return $this->hasMany(detalle_membresia::class,'id_venta');
    }

    

}
