<?php

namespace App\Imports;

use App\Models\ExcelPrueba;
use App\Models\ExcelPruebaDos;
use App\Models\Producto;
use App\Models\ProductosVendido;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isNull;

// use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ProductoImport implements ToModel, WithHeadingRow
// WithBatchInserts
{
    protected $rowNumber;

    public function __construct(&$rowNumber)
    {
        $this->rowNumber = &$rowNumber;
    }

    public function model(array $row)
    {
        // dd('llegeu a import prodcuto '); 
        $this->rowNumber++; // Incrementa el contador de filas
        // dd($row);
        // if (!isset($row['id_producto'])) {
            // || !isset($row['precio_con_factura'])
            if (!isset($row['cod_producto'])   ) {
            // dd('llegue en la fila', $this->rowNumber,$row);
            return null;
        }

        ## PARA CARGAR EL EXCEL DE PRODUCTOS DE GENERAL ACTUALIZADO
        //buscar producto por cod_producto
        $prod = Producto::where('cod_producto', $row['cod_producto'])->first();
        // dd($prod, $row);
        if(is_null($prod)){
            $prod = new Producto();
            $prod->id_tugerente = 0;
        }

        //PARA GENERAL PRODUCTOS 
        // $precio = floatval($row['precio_compra']);
        // $precio_con_iva  = round(($precio * 2) , 2);
        // $precio_sin_iva = $precio_con_iva - ($precio_con_iva * 0.13);
        // $precio_sin_iva  = round($precio_sin_iva , 2);
        // dd( $precio, $precio_con_iva,$precio_sin_iva);

        //PRECIO PARA EXCEL DE PERNOS
        $precio_con_iva = 0;
        if(!is_null($row['precio_con_factura'])){
            // dd('si se cargo');
            $precio_con_iva =  round(floatval($row['precio_con_factura']) , 2);
        }
        
        
        // $precio_con_iva =  round(floatval($row['precio_con_factura']) , 2);
        $precio =  round($precio_con_iva / 2 , 2); 
        $precio_sin_iva = $precio_con_iva - ($precio_con_iva * 0.13);
        $precio_sin_iva  = round($precio_sin_iva , 2);
        // dd($precio, $precio_con_iva,$precio_sin_iva);


        $prod->cod_producto = strtoupper($row['cod_producto']);
        $prod->cod_oem = !is_null($row['cod_oem']) ? strtoupper($row['cod_oem'])    :  $prod->cod_producto;	
        $prod->nombre = !is_null($row['nombre']) ? strtoupper($row['nombre']) :'';
        $prod->marca = !is_null($row['marca']) ? strtoupper($row['marca']):'MARCA'; //MARCA
        $prod->procedencia = !is_null($row['procedencia']) ? strtoupper($row['procedencia']):'NACIONAL'; //USA
        $prod->origen = !is_null($row['origen']) ? strtoupper($row['origen']):'BOLIVIA'; //USA
        $prod->cantidad = $row['cantidad']?:'0'; 
        $prod->cant_minima = 1;

        $prod->precio_compra = $precio; 
        $prod->precio_venta_sin_factura  = $precio_sin_iva;
        $prod->precio_venta_con_factura  = $precio_con_iva;
        $prod->foto = 'default.png';
        $prod->tienda ='FERRETERIA';
        $prod->unidad = 'PZA';
        $prod->estado = 'HABILITADO'; 
        $prod->estante = !is_null($row['estante']) ? strtoupper($row['estante']):'';
        $prod->id_proveedor = 2034;
        $prod->save();

        return null;
    

        // return new ProductosVendido([
        //     'id_venta' => $row['id_venta'],
        //     'id_producto' => $row['id_producto'], 
        //     'cod_sustituto' => $row['cod_sustituto'], 
        //     'cod_oem' => $row['cod_oem'],
        //     'nombre' => $row['nombre'],
        //     'precio_compra' => $row['precio'],
        //     'tienda' => $row['tienda']
        // ]);


        
        ## PARA CREAR UN JSON DE PRODUCTOS VENDIDOS, SACA LA IDTUGERENTE


        // return null;
    }

    // public function batchSize(): int
    // {
    //     return 100;
    // }
}
