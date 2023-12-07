<?php

namespace App\Exports;

use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\ExcelPrueba;
use App\Models\ExcelPruebaDos;
use App\Models\ProductosVendido;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductoExportView implements FromView
{
    public function view(): View
    {
        // $productos = ExcelPrueba::get();
        // $letras_sacar_dos = ['FP','PX','LK','MP','CR'];
        // $letras_sacar_tres = ['CUM','CTP','MAK','ROK','KMP','CAT','PAI','SKF','NAT','NAV',
        // 'DDC','HDK','VOL','FUL','STE','TIM','CRI','DAN','HTN','ETA','SAP','MAC','WAK','MID'];
        // $letras_sacar_cuatro = ['ARCA','SABO'];
        // $letras_sacar_cinco = ['VOLVO','MCBEE',];
    
        // $cadenas = [];
        // $acumulador = [];
        // $id_producto = [];
        // foreach($productos as $p){
        //     $cadena = $p->cod_oem;
        //     $acu = '';
        //     for ($i=0; $i < strlen($cadena); $i++) { 
        //         //sacar_5dig
        //         $acu = $acu.$cadena[$i];
        //         if(strlen($acu) == 2){
        //             if( in_array($acu,$letras_sacar_dos)){
        //                 $cadena = substr($cadena, 2);
        //                 $cadenas [] = $cadena;
        //                 $acumulador [] = $acu;
        //                 $id_producto [] = $p->id;
        //             }    
        //             break;
        //         }
        //     }
        // }        

        // return view('VistaProductos.exportar_productos', [
        //     // 'pr }}oductos' => $productos,
        //     'cadenas' => $cadenas,
        //     'acumulador' => $acumulador,
        //     'id_producto' => $id_producto,

        // ]);


        #############################################################################3

        // $productos = [];

        // $ventas = Venta::whereDate('fecha', '>=', '2023-03-15')->get();
        // foreach ($ventas as $venta) {
        //     $detalles = DetalleVenta::where('id_venta', $venta->id)->get();
        //     foreach ($detalles as $detalle) {
        //         if(!in_array($detalle->productos, $productos)){
        //             $productos[] = $detalle->productos;
        //         }  
        //     }
        // }

        // $cotizaciones = Cotizacion::whereDate('fecha_realizada','>=', '2023-07-01')->get();
        // foreach ($cotizaciones as $cotizacion) {
        //     $detalles = DetalleCotizacion::where('id_cotizacion', $cotizacion->id)->get();
        //     foreach ($detalles as $detalle) {    
        //         if(!in_array($detalle->productos, $productos)){
        //             $productos[] = $detalle->productos;
        //         }  
        //     }
        // }

        // return view('VistaProductos.exportar_productos', [
        //     'productos' => $productos,
        // ]);

        ##### PRODUCTOS QUE SE VENDIERON O SE COTIZARON LUEGO DE 15 DE JULIO #####
        // $ventas = Venta::get(); //whereDate('fecha', '>=', '2023-07-15')->
        // // dd($ventas);
        // $codigos = [];
        // $productos = [];
        // foreach ($ventas as $v) {
        //     $detalles = DetalleVenta::where('id_venta', $v->id)->get();
        //     // dd($detalles, $v->id);
        //     foreach ($detalles as $d) {
        //         $p = Producto::where('id', $d->id_producto)->first();
        //         if(!in_array($p->id, $codigos)){
        //             // $codigos[] = $p->id;
        //             array_push($codigos, $p->id);
        //             // $productos[] = [
        //             //     'id_venta' => $v->id,
        //             //     'id_producto' => $p->id,
        //             //     'cod_oem' => $p->cod_oem,
        //             //     'cod_sustituto' => $p->cod_sustituto,
        //             //     'nombre' => $p->nombre,
        //             //     'precio' => $p->precio_compra,
        //             //     'tienda' => $p->tienda,
        //             // ];

        //         }
        //     }
        // }

        // $cotizaciones = Cotizacion::get(); //whereDate('fecha_realizada', '>=', '2023-07-15')->
        // // dd($cotizaciones);
        // foreach ($cotizaciones as $c) {
        //     // dd($c);
        //     $detalles = DetalleCotizacion::where('id_cotizacion', $c->id)->get();
        //     // dd($detalles, $c->nro_coti);
        //     foreach ($detalles as $d) {
        //         $p = Producto::where('id', $d->id_producto)->first();
        //         if(!in_array($p->id, $codigos)){
        //             // $codigos[] = $p->id;
        //             array_push($codigos, $p->id);
        //             // $productos[] = [
        //             //     'id_venta' => strval($c->id).'coti' ,
        //             //     'id_producto' => $p->id,
        //             //     'cod_oem' => $p->cod_oem,
        //             //     'cod_sustituto' => $p->cod_sustituto,
        //             //     'nombre' => $p->nombre,
        //             //     'precio' => $p->precio_compra,
        //             //     'tienda' => $p->tienda,
        //             // ];
        //         }
        //     }
        // }

        // $productos = [];
        // foreach ($codigos as $c) {
        //     $p = Producto::where('id', $c)->first();
        //     $productos[] = $p;
        // }
    

           #############################################################################
           //productos vendidos que no estan en general 
        // $productos = [];
        // $vendidos = ProductosVendido::get();
        // foreach ($vendidos as $v) {
        //     //sacar productos  
        //     $prod = Producto::where('id', $v->id_producto)->first(); 

        //     if($prod->tienda == 'Repuestos'){
        //         $prodExcel = ExcelPrueba::where('cod_oem', $prod->cod_oem)->first();
        //         // dd($prodExcel, $prod);
        //         if(is_null($prodExcel)){
        //             // dd('entre es null',$prod);
        //             $prodExcel = ExcelPrueba::where('cod_oem', $prod->cod_sustituto)->first();
        //             if(is_null($prodExcel)){
        //                 $prodExcel = ExcelPrueba::where('cod_producto', $prod->cod_oem)->first();
        //                 if(is_null($prodExcel)){
        //                     $prodExcel = ExcelPrueba::where('cod_producto', $prod->cod_sustituto)->first();
        //                     if(is_null($prodExcel)){
        //                         //anioadir a la lista de productos
        //                         $productos[] = [
        //                             'id_venta' => $v->id_venta,	
        //                             'id_producto' => $prod->id,
        //                             'cod_oem' => $prod->cod_oem,
        //                             'cod_sustituto' => $prod->cod_sustituto,
        //                             'nombre' => $prod->nombre,
        //                             'precio' => $prod->precio_compra,
        //                             'tienda' => $prod->tienda,
                                    
        //                         ];
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        

        // dd( $productos);
        

        $productos = Producto::get();
        return view('VistaProductos.exportar_productos', [
                'productos' => $productos,
        ]);

    }
}
