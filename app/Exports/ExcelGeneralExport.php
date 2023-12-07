<?php

namespace App\Exports;

use App\Models\ExcelPrueba;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelGeneralExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd('llegue');
        // $productos = ExcelPrueba::select('cod_producto')
        // ->groupBy('cod_producto')
        // ->havingRaw('COUNT(cod_producto) >= 2')
        // ->get();

        // $estados = array();
        // $productos = Producto::all();
        // $cc = 0;
        // foreach ($productos as  $p) {
        //     if(!in_array($p->tienda, $estados ) ){
        //         array_push($estados, $p->tienda);
        //     }
        //     $cc++;
        // }
        // dd($cc,$estados);

        // produtos solo de repuestos 
        $productos = Producto::where('tienda', 'Repuestos')->get();
        return $productos;
    }
}
