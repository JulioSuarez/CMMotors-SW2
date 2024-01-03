<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoint extends Model
{
    use HasFactory;

    //productos
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
    //ventas
    public function ventas()
    {
        return $this->hasMany('App\Models\Venta');
    }
    //detalle ventas
    public function detalleVentas()
    {
        return $this->hasMany('App\Models\DetalleVenta');
    }
    //clientes
    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente');
    }
    //empleados
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
    //proveedores
    public function proveedores()
    {
        return $this->hasMany('App\Models\Proveedor');
    }
    //cotizaciones
    public function cotizaciones()
    {
        return $this->hasMany('App\Models\Cotizacion');
    }
    //detalle cotizaciones
    public function detalleCotizaciones()
    {
        return $this->hasMany('App\Models\DetalleCotizacion');
    }
}
