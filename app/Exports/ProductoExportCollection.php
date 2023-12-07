<?php

namespace App\Exports;

use App\Models\ExcelPrueba;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductoExportCollection implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ExcelPrueba::all();
    }
}
