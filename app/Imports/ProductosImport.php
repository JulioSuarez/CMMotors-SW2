<?php

namespace App\Imports;

use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $data = [];
        $columna = [
            'cod_oem',
            'cod_sustituto',
            'nombre',
            'marca',
            'procedencia',
            'origen',
            'descripcion',
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
            'categoria',
            'id_proveedor'
        ];


        foreach ($row as $indice => $valor) {
            // if($indice >=1){
            $data[$columna[$indice]] = $valor;
            // }
        }
        // dd($data);
        $producto = Producto::where('cod_oem', $data['cod_oem'])->first();
        if (!is_null($producto)) {
            //     // $data['id_producto']= 0;
            //     $data['id_producto']= ProductoController::__storeGerente($data['cod_oem'], $data['nombre']);
            //     Producto::create($data);
            $producto->estante = $data['estante'];
            $producto->save();
        }
        //la siguiente linea es para aumentar el limite de tiempo de la peticion API tugerente
        set_time_limit(300);
        return;
        // return new Producto($data);
    }
}
