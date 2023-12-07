<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Venta;
use App\Models\DetalleVenta;
use PDF;

class PruebasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // NOTA: actualmente muestra el template con el nombre template
        /*
        $user = Auth::user()->nombre_usuario;
        $proveedor = Proveedor::get();
        $p = Producto::first();
        $p2 = Producto::join('proveedors', 'proveedors.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'proveedors.nombre_proveedor', 'proveedors.proveedor_direccion', 'proveedors.nombre_proveedor_contacto', 'proveedors.proveedor_telefono')->first();
        // dd($p);
        // dd($user);
        //return view('pruebas.navegador',compact('user'));
        $clientes = Cliente::get();

        $xd = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
            ->join('ventas as v', 'v.id', '=', 'detalle_ventas.id_venta')
            ->select('detalle_ventas.*', 'p.nombre', 'p.precio_compra', 'v.fecha', 'v.descuento')->get();

        $ventas= Venta::join('detalle_ventas as dv','ventas.id','=','dv.id_venta')
            ->join('productos as p','p.id','=','dv.id_producto')
            ->select('ventas.id','dv.detalle','dv.cantidad','p.precio_compra','dv.precio_producto_unitario','dv.precio as monto_total')->get();
        */
        return view('pruebas.template'); //, compact('user','proveedor','p','p2','clientes','xd','ventas'));
    }

    public function reporte()
    {


        $productos = Producto::get();
        $ventas = Venta::get();
        $detalles = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')->get();
        $utilidades = array();
        $suma_pu = array();
        $suma_u = array();
        $suma_xd = floatval(0);
        $c = 0;

        foreach ($ventas as $v) {
            $suma_uni = floatval(0); //suma de todo los unitarios;
            $det = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
                ->select('p.precio_compra')
                ->where('id_venta', $v->id)->get();

            foreach ($det as $d) {
                $suma_uni += floatval($d->precio_compra);
            }
            array_push($suma_pu, $suma_uni);
            $uti = floatval($v->monto_total) - $suma_uni;
            array_push($utilidades, $uti);

            $suma_xd += floatval($utilidades[$c]);
            array_push($suma_u, $suma_xd);
            // dd($suma_u);
            $c++;
        }


        return view('pruebas.reporte', compact('utilidades', 'ventas', 'suma_pu', 'suma_pu', 'suma_xd', 'productos'));
    }
    public function ventasUtilidades()
    {
        $ventas = Venta::get();
        $detalles = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')->get();
        $utilidades = array();
        $suma_pu = array();
        $suma_u = array();
        $suma_xd = floatval(0);
        $c = 0;

        foreach ($ventas as $v) {
            $suma_uni = floatval(0); //suma de todo los unitarios;
            $det = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
                ->select('p.precio_compra')
                ->where('id_venta', $v->id)->get();

            foreach ($det as $d) {
                $suma_uni += floatval($d->precio_compra);
            }
            array_push($suma_pu, $suma_uni);
            $uti = floatval($v->monto_total) - $suma_uni;
            array_push($utilidades, $uti);

            $suma_xd += floatval($utilidades[$c]);
            array_push($suma_u, $suma_xd);
            // dd($suma_u);
            $c++;
        }
        // return view('pruebas.repo', compact('utilidades','ventas','suma_pu'));
        $pdf = PDF::loadView('pruebas.repo', ['utilidades' => $utilidades, 'ventas' => $ventas, 'suma_pu' => $suma_pu, 'suma_xd' => $suma_xd])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        // dd($fecha);
        return $pdf->stream('Reporte-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }

    public function ListaProductos()
    {
        $productos = Producto::get();
        $pdf = PDF::loadView('pruebas.listaproductos', ['productos' => $productos])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        // dd($fecha);
        return $pdf->stream('Lista-de-Productos-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }
    public function ListaProductosi()
    {
        $productos = Producto::get();
        $pdf = PDF::loadView('pruebas.listaproductosi', ['productos' => $productos])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        // dd($fecha);
        return $pdf->stream('Lista-de-Productos-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pdf2(Venta $venta)
    {

        $clientes = Cliente::get();

        $xd = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
            ->select('detalle_ventas.*', 'p.cod_oem', 'p.nombre as nombre_producto')
            ->where('detalle_ventas.id_venta', $venta->id)->get();


        $xds = Venta::join('empleados as e', 'e.ci', '=', 'ventas.ci_empleado')
            ->join('clientes as c', 'c.ci', '=', 'ventas.ci_cliente')
            ->select(
                'ventas.*',
                'e.nombre as nombre_empleado',
                'c.nombre as nombre_cliente',
                'c.empresa'
            )
            ->where('ventas.id', $venta->id)->first();

        $pdf = PDF::loadView('VistaVentas.imprimir', ['xd' => $xd, 'xds' => $xds, 'clientes' => $clientes])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        return $pdf->stream('Factura-NRO' . '.pdf', ['Attachment' => 'true']);
    }

    public function prodpdf()
    {
        $var = GetProductosxd()->json_decode();
        $pdf = PDF::loadView('pruebas.productobk', compact('var'))
            ->setPaper('letter', 'portrait');
        dd($var);
        return $pdf->stream('backup' . '.pdf', ['Attachment' => 'true']);
    }

    public function GetProductosxd()
    {
        $pr = Producto::get();
        $cl = Cliente::get();
        $pv = Proveedor::get();
        $e = Empleado::get();
        $v = Venta::get();
        $dv = DetalleVenta::get();
        $co = Cotizacion::get();
        $dco = DetalleCotizacion::get();

        return response()->Json([
            "Productos" => $pr,
            "Clientes" => $cl,
            "Proveedores" => $pv,
            "Empleados" => $e,
            "Ventas" => $v,
            "DetallesVentas" => $dv,
            "Cotizaciones" => $co,
            "DetallesCotizaciones" => $dco,

        ]);
    }

    public function cliente_pdf(Cliente $c)
    {
        $fecha = date('d-m-Y');
        $clientes = Cliente::get();
        $pdf = PDF::loadView('VistaClientes.lista', ['clientes' => $clientes])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Clientes-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }
    public function empleado_pdf(Empleado $e)
    {
        $fecha = date('d-m-Y');
        $empleados = Empleado::get();
        $pdf = PDF::loadView('VistaClientes.listaEmpleados', ['empleados' => $empleados])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Empleados-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }
    public function proveedor_pdf(Proveedor $p)
    {
        $fecha = date('d-m-Y');
        $proveedores = Proveedor::get();
        $pdf = PDF::loadView('VistaClientes.listaProveedores', ['proveedores' => $proveedores])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Proveedores-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }

    public function descargasxd($id)
    {
        $productos = Producto::where('id', $id)->first();
        foreach ($productos as $p) {
            $varible = public_path('img/fotosProductos/' . $p->foto);
        }
        return response()->download($varible);
    }

    public function reporteVentasFecha(Request $r)
    {
        // dd($r);
        // $ventas = Venta::where('ventas.fecha', '>=', date('Y-m-d', strtotime('-' . $r->dias . ' day')))
        // ->where('ventas.fecha', '<=', date('Y-m-d'))
        $ventas = Venta::when(Request('dias'), function ($q) {
            $rr = Request('dias');
            // $fecha_actual = date('Y-m-d')
            if ($rr == '0') {
                return $q;
            } else {
                if (($rr == '1') || ($rr == '7') || ($rr == '30') || ($rr == '90') || ($rr == '180')) {
                    // dd('entre en:'.$rr);
                    return $q->where('ventas.fecha', '>=', date('Y-m-d', strtotime('-' . $rr . ' day')))
                        ->where('ventas.fecha', '<=', date('Y-m-d'));
                } else {
                    return $q->where('ventas.fecha', '>=', $rr . '-01-01')
                        ->where('ventas.fecha', '<=',  $rr . '-12-31');
                }
            }
        })->get();






        $detalles = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')->get();
        $utilidades = array();
        $suma_pu = array();
        $suma_u = array();
        $suma_xd = floatval(0);
        $c = 0;

        foreach ($ventas as $v) {
            $suma_uni = floatval(0); //suma de todo los unitarios;
            $det = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
                ->select('p.precio_compra')
                ->where('id_venta', $v->id)->get();

            foreach ($det as $d) {
                $suma_uni += floatval($d->precio_compra);
            }
            array_push($suma_pu, $suma_uni);
            $uti = floatval($v->monto_total) - $suma_uni;
            array_push($utilidades, $uti);

            $suma_xd += floatval($utilidades[$c]);
            array_push($suma_u, $suma_xd);
            // dd($suma_u);
            $c++;
        }
        // return view('pruebas.repo', compact('utilidades','ventas','suma_pu'));
        $pdf = PDF::loadView('pruebas.reporteFecha', ['utilidades' => $utilidades, 'ventas' => $ventas, 'suma_pu' => $suma_pu, 'suma_xd' => $suma_xd])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        $a = date('Y-m-d', strtotime('-' . $r->dias . ' day'));
        // dd($fecha);
        if ($r->dias == '0') {
            return $pdf->stream('Reporte de ventas hasta ' . $fecha . '.pdf', ['Attachment' => 'true']);
        } else {
            return $pdf->stream('Reporte de ventas desde - ' . $a . ' a ' . $fecha . '.pdf', ['Attachment' => 'true']);
        }
    }


    public function facturar()
    {
        return view('pruebas.facturar');
    }
}
