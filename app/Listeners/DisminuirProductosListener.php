<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Producto;

class DisminuirProductosListener
{

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event->cantidad);
        $producto = Producto::where('id',$event->id_producto)->first();
        //dd($producto);
        $producto->cantidad =$producto->cantidad - $event->cantidad;
        $producto->save();



    }
}
