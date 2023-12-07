<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActualizarUbicacionImport implements ToModel,WithHeadingRow
{
    protected $rowNumber;

    public function __construct(&$rowNumber)
    {
        $this->rowNumber = &$rowNumber;
    }

    public function model(array $row)
    {
       
        $this->rowNumber++; // Incrementa el contador de filas

        if (!isset($row['cod_producto']) || !isset($row['ubicacion']) ) {
            dd('llegue en la fila', $this->rowNumber,$row);
            return null;
        }

        $producto = Producto::where('cod_oem', $row['cod_producto'])->first();
        
        // dd($producto, $row);
        if(!is_null($producto)){    
            $producto->estante = $row['ubicacion'];
            $producto->marca = $row['marca'];
            $producto->procedencia = $row['procedencia'];
            $producto->origen = $row['origen'];
            $producto->cantidad = $row['cantidad'];
            $producto->save();
        }

        return null;
    }
}
