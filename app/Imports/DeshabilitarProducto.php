<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeshabilitarProducto implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //  dd('esty en deshabiltar producto');
         if (!isset($row['cod_producto']) ) {
            // dd('llegue en la fila',$row);
            return null;
        }
        // dd('pase');

        //buscar el producto y reemplazar los datos 
        $producto = Producto::where('cod_oem', $row['cod_producto'])->first();
        
        // dd($producto, $row);
        if(!is_null($producto)){    
            // $producto->estado = $row['valor_al_costo'];
            $producto->estado = 'EliminarTuGerente';
            $producto->save();
        }else{
            // dd('no encontre el producto', $row);
        }
        return null;
    }
}
