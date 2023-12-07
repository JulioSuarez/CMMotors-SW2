<?php

namespace App\Exports;

use App\Imports\VerificadorImport;
use App\Models\ExcelPrueba;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VerificadorExport implements FromView
{
   
    public function view(): View
    {
        // dd('llegue xdxdxdxd ');
        $productos = VerificadorImport::getProductosxd();

        // dd($productos);
        return view('VistaProductos.exportar_productos', [
            'productos' => $productos,
        ]);

    }
}
