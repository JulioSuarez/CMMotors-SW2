<?php

namespace App\Imports;

use App\Models\ExcelPrueba;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActualizarProductosImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {   
        // dd('esty en actualizar productos import');
        if (!isset($row['cod_producto']) ) {
            // dd('llegue en la fila',$row);
            return null;
        }
        // dd('pase');

        //buscar el producto y reemplazar los datos 
        $producto = ExcelPrueba::where('cod_producto', $row['cod_producto'])->first();
        
        // dd($producto, $row);
        if(!is_null($producto)){    
            $producto->precio_compra = $row['valor_al_costo'];
            $producto->save();
        }else{
            // dd('no encontre el producto', $row);
        }


        // return new ExcelPrueba([
        //     //
        // ]);
        return null;
    }
}
