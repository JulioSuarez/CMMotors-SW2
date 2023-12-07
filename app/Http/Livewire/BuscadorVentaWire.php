<?php

namespace App\Http\Livewire;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Livewire\Component;

class BuscadorVentaWire extends Component
{
  

    public function render()
    {
        $ventas = Venta::get();

        dd($ventas->detalles);
        // $detalles_venta = DetalleVenta::get();
        


      
      
        return view('livewire.buscador-venta-wire',
         compact(   
                'ventas', 
                'detalles_venta'
            ));
    }
}
