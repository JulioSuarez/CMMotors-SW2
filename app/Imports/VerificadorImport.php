<?php

namespace App\Imports;

use App\Models\ExcelPrueba;
use App\Models\ExcelPruebaDos;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class VerificadorImport implements ToModel,WithHeadingRow
{
    protected static $productosxd = [];

    public function model(array $row)
    {    
        if (!isset($row['cod_producto']) ) {
            // dd('llegue en la fila',$row);
            return null;
        }

        // verifcar que no este mas de 2 veces el mismo producto
        // $prod= ExcelPrueba::where('cod_producto', $row['cod_producto'])->first();
       
        // if(!is_null($prod)){
        //     if(is_null($prod->nombre)){
        //         $prod->nombre = trim($row['producto']);
        //         $prod->save();
        //     }
        // }
        

        // ACTULIZAR EXCEL
        //eliminar espacios en blanco
        // $cadena = trim($row['cod_fabricante']);
        // $acu = '';
        // for ($i=0; $i < strlen($cadena); $i++) { 

        //     if($cadena[$i] == ' ' || $cadena[$i]  == '-' || $cadena[$i]  == '_' || $cadena[$i]  == '.' || $cadena[$i]  == ','){
        //         // dd('es igual a espacio,',$row);
        //     }else{
        //         $acu .= $cadena[$i];
        //     }
        // }


        //A,S,M  //falta corregir esto
        // $letras_sacar_dos = ['FP','PX','LK','MP','CR'];
        // $letras_sacar_tres = ['CUM','CTP','MAK','ROK','KMP','CAT','PAI','SKF','NAT','NAV',
        // 'DDC','HDK','VOL','FUL','STE','TIM','CRI','DAN','HTN','ETA','SAP','MAC','WAK','MID'];
        // $letras_sacar_cuatro = ['ARCA','SABO'];
        // $letras_sacar_cinco = ['VOLVO','MCBEE',];

        // for ($i=0; $i < strlen($cadena); $i++) { 
        //     //sacar_5dig
        //     $acu = $acu.$cadena[$i];
        //     if(strlen($acu) == 2){
        //         if( in_array($acu,$letras_sacar_dos)){
        //             $cadena = substr($cadena, 2);
        //             // dd($cadena);
        //         }    
        //         break;
        //     }
        // }
    

        // $prod = [];
        // $prod['cod_producto'] = trim($row['cod_producto']);
        // // $prod['cod_oem'] = trim($producto->cod_oem);
        // $prod['cod_fabricante'] = $cadena;  //trim($row['cod_fabricante']);
        // $prod['producto'] = trim($row['producto']);
        // $prod['costo_unitario'] = trim($row['costo_unitario']);
        // $prod['precio_bs'] = trim($row['precio_bs']);
        // self::$productosxd[] = $prod ;


        ###############################################################
         //buscar el producto y reemplazar los datos 
        //  $producto = ExcelPrueba::where('cod_producto', $row['cod_producto'])->first();
        // $producto = Producto::where('cod_oem', $row['cod_producto'])->first(); 

        //  if(is_null($producto)){    
        //     // $this->productosxd[] = $row['cod_producto'];
        //     self::$productosxd[] = $row['cod_producto'];
        // }

        ##################### verificar los cod_oem  ##########################################
        // $producto = ExcelPrueba::where('cod_producto', $row['cod_producto'])->first();
        // // dd($producto, $row);
        // if(!is_null($producto)){ 
        //     if(trim($producto->cod_oem) != '')   {
        //         if(trim($producto->cod_oem) != trim($row['cod_fabricante'] )){
        //             $prod = [];
        //             $prod['cod_producto'] = trim($row['cod_producto']);
        //             $prod['cod_oem'] = trim($producto->cod_oem);
        //             $prod['cod_fabricante'] = trim($row['cod_fabricante']);
        //             self::$productosxd[] = $prod ;
        //         }
        //     }
        // }

         ##################### productos que no estan en general de sacar cod_oem ##########################################
        //  $producto = ExcelPruebaDos::where('cod_producto', $row['cod_producto'])->first();

        //  // dd($producto, $row);
        //  if(!is_null($producto)){ 
        //      if(trim($producto->cod_oem) != '')   {
        //          if(trim($producto->cod_oem) != trim($row['cod_fabricante'] )){
        //              $prod = [];
        //              $prod['cod_producto'] = trim($row['cod_producto']);
        //              $prod['cod_oem'] = trim($producto->cod_oem);
        //              $prod['cod_fabricante'] = trim($row['cod_fabricante']);
        //              self::$productosxd[] = $prod ;
        //          }
        //      }
        //  }
        //  return null;

         //si es igaul verifaicar 
         //si no crear un nuevo producto

        //  $p = ExcelPruebaDos::where('cod_oem', $row['cod_producto'])->first();
        //     if(!is_null($p)){
        //         //verifcar precio y nombre 

        //         if($p->costo_producto != floatval($row['costo_producto'])){
        //             // dd('es diferente en ', $p->costo_producto, floatval($row['costo_producto']), $p, $row);
        //         $p->costo_producto = floatval($row['costo_producto']);
        //         $p->save();
        //         }
        //     }else{
        //         ExcelPruebaDos::create([
        //             'cod_producto' => $row['cod_producto'], 
        //             'nombre' => $row['descripcion'], 
        //             // 'cod_oem' => $row['cod_fabricante'],
        //             'costo_producto' => $row['costo_producto'],
        //         ]);
        //     }
        //  return null;



        //devolver a julico 
        //buscar producto
        $producto = Producto::where('cod_oem', $row['cod_oem'])->get();
        
        if(count($producto) == 0){
            $producto = Producto::where('cod_sustituto', $row['cod_oem'])->get();
            if(count($producto) == 0){
                // dd($producto, $row,'es null');
            }
        }

        //si llega aca es por que no es null
        if(count($producto) > 1 ){
            dd('es ayor que uno', $producto, $row);
        }else{
            // dd('solo se pillo en un producto', $producto, $row);
            // poner nombre y precio en la nueva lista 
            if(count($producto)!= 0){
                $prod = [];
                $prod['cod_producto'] = $row['cod_producto'];
                $prod['cod_oem'] = $row['cod_oem'];
                $prod['nombre'] = $producto[0]->nombre;
                $prod['precio'] = $producto[0]->precio_compra;
                $prod['prod_id'] = $producto[0]->id;
                $prod['prod_cod_oem'] = $producto[0]->cod_oem;
                $prod['prod_cod_sustito'] = $producto[0]->cod_sustituto;
                self::$productosxd[] = $prod ;
    
            }
        }
        return null;




        //buscar con el cod_oem

        //verificar si esta en cod_oem, 
        // tambien buscar en cod_sustituto, antes verificar si el mismo id de producto no esta en cod_oem


    }

    public static function getProductosxd(){
        return self::$productosxd;
    }

    public static function setProductosxd($productosxd){
        self::$productosxd = $productosxd;
    }
}
