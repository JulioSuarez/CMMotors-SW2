<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\DetalleVenta;

class middlaware_ventas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $r, Closure $next)
    {
        //poner en una variable detalles las r
        // dd($r);

        // $len = count($r->cod_oem);
        // for ($i=0; $i <$len ; $i++) {

        //

//    $hola = 'que onda puto!!';
//    $productos = Producto::get();
    // return back()->with('hola',$productos);
    // // return back()->withInput();
    // return $next($r);


// //validacion de cliente
// $r->validate([
//     'ci_empleado' => 'required',
//     'ci_cliente' => 'required',
//     'cliente' => 'required',
//   //  'telefono' => 'required',
//   //  'cod_oem2' => 'required',
//     //'precio_sin_factura' => 'required',
//     //'estante' => 'required',
//     //'cantidad' => 'required',;
// ]);

// dd($r);
if($r->ventana== 'edit_ventas'){
    // dd('entre');
    if (is_null($r->ci_cliente)){
        return back()->with("volvi_ci","Se debe registrar el CI")->withInput();
    }elseif(is_null($r->cliente)){
        return back()->with("volvi_cliente","Se debe registrar el nombre")->withInput();
    }
}

// if(is_null($r->nro_coti)){
//     return back()->with("volvi_coti1","Obiga")->withInput();
// }

//validacion de la cod_oem
if(is_null($r->cod_oem)){
    return back()->with("volvi_ventas1","Debe seleccionar al menos un producto")->withInput();
}
        $len = count($r->cod_oem);
      // dd($len);
        for ($i=1; $i <=$len ; $i++) {
            if(is_null($r->cod_oem[$i-1])){
                return back()->with("volvi_ventas","El Code OEM esta vacio en la fila {$i}")->withInput();
            }

            $pro = Producto::where('cod_oem',$r->cod_oem[$i-1])->first();
        //     dd($pro);
            if(is_null($pro)){
                return back()->with("volvi_ventas2","El producto no existe en la fila {$i}")->withInput();
            }

            // dd($r);
            $cant = DetalleVenta::join('productos as p','p.id','=','detalle_ventas.id_producto')
                                    ->select('detalle_ventas.cantidad as cant_detalle','p.cantidad as cant_prod')
                                    ->where('id_venta',$r->id_venta)
                                     ->where('p.cod_oem',$r->cod_oem[$i-1])->first();

            // $cant_nueva = $r->cantidad[$i];
            // dd($cant);
            if(is_null($cant)){
                // create
                if($r->cantidad[$i-1] > $pro->cantidad){
                    return back()->with("volvi_ventas3","Cantidad no disponible de {$pro->nombre} en la fila {$i}")->withInput();
                }
            }else{
                // edit
                $cant_prod =  $cant->cant_detalle + $cant->cant_prod;
                if($r->cantidad[$i-1] > $cant_prod){
                    return back()->with("volvi_ventas3","Cantidad no disponible de {$pro->nombre} en la fila {$i}")->withInput();
                }
            }


        }


       return $next($r);
    }
}
