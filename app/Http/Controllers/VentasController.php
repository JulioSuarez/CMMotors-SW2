<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatosGeneral;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Pago;
use PDF;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class VentasController extends Controller
{

    public function index()
    {
        $nro_venta = Request('nro_venta');
        $empleado = Request('empleado');
        $cliente = Request('cliente');
        $producto = Request('producto');
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        $realizadas_en = Request('realizadas_en');
        $estado = Request('estado');

        $ventas = Venta::join('clientes as c', 'c.ci', '=', 'ventas.ci_cliente')
            ->join('empleados as e', 'e.ci', '=', 'ventas.ci_empleado')
            ->select('ventas.*', 'c.nombre as nom_cliente', 'e.nombre as nom_empleado')
            ->when(Request('nro_venta'), function ($q) {
                return $q->where('ventas.id', 'like', '%' . Request('nro_venta') . '%');
            })
            ->when(Request('empleado'), function ($q) {
                // dd('Mauricio Guitierrez');
                if (is_numeric(Request('empleado'))) {
                    return $q->where('e.ci', Request('empleado'));
                } else {
                    return $q->where('e.nombre', 'like', '%' . Request('empleado') . '%');
                }
            })
            ->when(Request('cliente'), function ($q) {
                // dd('Mauricio Guitierrez');
                if (is_numeric(Request('cliente'))) {
                    return $q->where('c.ci', Request('cliente'));
                } else {
                    return $q->where('c.nombre', 'like', '%' . Request('cliente') . '%');
                }
            })
            ->when(Request('fecha_antes'), function ($q) {
                return $q->where('ventas.fecha', '>=', Request('fecha_antes'));
            })
            ->when(Request('fecha_hasta'), function ($q) {
                return $q->where('ventas.fecha', '<=', Request('fecha_hasta'));
            })
            //de abajo calcula lo del realizados en.....
            ->when(Request('realizadas_en'), function ($q) {
                $rr = Request('realizadas_en');
                // $fecha_actual = date('Y-m-d')
                if ($rr == 'null') {
                    return $q;
                } else {
                    if (($rr == '1') || ($rr == '7') || ($rr == '30') || ($rr == '90')) {
                        // dd('entre en:'.$rr);
                        return $q->where('ventas.fecha', '>=', date('Y-m-d', strtotime('-' . $rr . ' day')))
                            ->where('ventas.fecha', '<=', date('Y-m-d'));
                    } else {
                        return $q->where('ventas.fecha', '>=', $rr . '-01-01')
                            ->where('ventas.fecha', '<=',  $rr . '-12-31');
                    }
                }
            })
            ->orderByDesc('ventas.id')->get();
        // dd($ventas);

        //para reazliar busquedas con produtos
        if (!is_null(Request('producto'))) {

            $prod_id = Producto::where('cod_producto', $producto)->first();
            // dd('hay datos no es null', $producto , $prod_id);
            $ventas = $ventas->filter(function ($v) use ($prod_id) {
                if (is_null($prod_id))
                    return false;

                $detalles = DB::table('detalle_ventas')
                    ->where('id_venta', $v->id)
                    ->where('id_producto', $prod_id->id)
                    ->get();
                if (count($detalles) > 0) {
                    return true;
                } else {
                    return false;
                }
            })->values();
        }
        // dd($ventas);
        $detalles_venta = DetalleVenta::get();
        // dd($detalles_venta);

        return view('VistaVentas.index1', compact(
            'ventas',
            'detalles_venta',
            'nro_venta',
            'empleado',
            'cliente',
            'fecha_antes',
            'fecha_hasta',
            'realizadas_en',
            'estado',
            'producto'

        ));
    }

    public function consultarVentas()
    {
        $ventas = Venta::get();
        $detalles_venta = DetalleVenta::get();
        // dd($detalles_venta);

        return view('VistaVentas.index_wire', compact(
            'ventas',
            'detalles_venta',
        ));
    }


    public function create()
    {
        $datos = DatosGeneral::get();
        $user = Auth::user()->id;
        $empleado = Empleado::join(
            'users',
            'users.id',
            '=',
            'empleados.id_usuario'
        )->select('empleados.*', 'users.nombre_usuario')
            ->where('id_usuario', $user)->first();

        //  $productos = Producto::get();
        return view('VistaVentas.create1', compact('empleado', 'datos'));
    }


    public function storeVolverASubir(Venta $venta)
    {
        set_time_limit(120);
        // dd($venta);
        //buscar sus detalles
        $detventas = DetalleVenta::where('id_venta', $venta->id)->get();
        // dd( $detventas);
        $detalles = [];
        foreach ($detventas as $d) {
            $producto = Producto::where('id', $d->id_producto)->first();
            $detalle = [
                "product" => $producto->id_tugerente,
                "price" => $d->precio_producto_unitario,
                "qty" => $d->cantidad,
                "total" => $d->precio, //cantidad * precio unitario
            ];
            $detalles[] = $detalle;
        }
        // dd($detalles);

        $cliente = Cliente::where('ci', $venta->ci_cliente)->first();
        // dd($cliente);
        //verificar si el cliente tiene un id_cliente diferente de 0
        if ($cliente->id_tugerete == 0) {
            //si es 0, entonces crear un nuevo cliente
            $cliente->id_tugerete = $this->__storeClienteGerente($cliente->nombre, $cliente->ci);
            $cliente->save();
        }
        // dd('entre a crear una nueva venta');
        $id_venta = $this->__storeTuGerente($venta->monto_total, $cliente->id_tugerete, $detalles);
        // $id_venta = 11228535;
        //buscar el nuro de factura
        $venta->nro_factura = $this->getNroFactProducto($id_venta);
        // dd($venta);

        //verificar si el id_venta es diferente de 1111
        if ($id_venta == 0) {
            //si es 0, entonces no se pudo crear la venta
            return redirect()->route('Venta.index')->with('error_gerente', 'No se pudo crear la factura, vuelve a intentarlo!');
        } else {
            //ahora actualizar el id_venta de la venta que se subio
            $venta->id_venta = $id_venta;
            $venta->save();
            return redirect()->route('Venta.index')->with('success', 'Factura realizada con exito');
        }
    }

    //original el que si funiocan, esta para el fecth
    public function storeVolverASubirXD(Venta $venta)
    {
        return;
    }

    public function store(Request $r)
    {
        // dd($r);
        //validaciones
        $r->validate([
            'ci_empleado' => 'required',
            'ci_cliente' => 'required',
            'cliente' => 'required',
        ]);
        $id_venta = 0;
        try {
            DB::transaction(function () use ($r, &$id_venta) {
                // $id_cliente = 0;
                $c = Cliente::where('ci', $r->ci_cliente)->first();
                if ($c == null) {
                    $c = new Cliente();
                    // $c->id_cliente = $this->__storeClienteGerente($r->cliente, $r->ci_cliente);
                    $c->id_cliente = $r->ci_cliente;
                }
                // $id_cliente = $c->id_cliente;
                $c->ci = $r->ci_cliente;
                $c->nombre = $r->cliente;
                $c->empresa =  $r->empresa;
                $c->nit =  $r->nit;
                //$c->correo = $r->correo;
                $c->telefono =  $r->telefono;
                // $c->direccion = $r->direccion;
                $c->save();

                // $xd = new DatosGeneral();
                // $xd->tipo_de_cambio = $r->tc;
                // $xd->forma_pago = $r->fpago;
                // $xd->cheque = $r->cheque;
                // $xd->cuenta_bancaria = $r->cuenta;
                // $xd->entrega = $r->entrega;
                // $xd->nota = $r->nota;
                // $xd->save();


                // dd($r);
                $v = new Venta();
                $v->monto_total = $r->monto_total;
                $v->fecha = date('Y-m-d'); //hacerlo automatico
                $v->hora = date('H:i:s');  //hacerlo automatico
                $v->ci_cliente = $r->ci_cliente;
                $v->ci_empleado = $r->ci_empleado; //dacar el nombre del empleado

                $v->descuento = $r->descuento;
                $v->total_en_bolivianos = $r->total_en_bolivianos;
                $v->total_en_dolares = $r->total_en_dolares;
                $v->id_datos_generales = 1;
                $v->id_venta = $id_venta;
                $v->save();

                // dd($r->nit);
                //dd(count($r->cod_oem));
                //  falta cargar empres, nit , telefono
                $detalles = [];
                $detalleMetodoPagoQR = [];
                for ($i = 0; $i < count($r->cod_oem); $i++) {
                    $producto = Producto::where('cod_producto', $r->cod_oem[$i])->first();

                    $d = new DetalleVenta();
                    $d->detalles = $r->detalles[$i];
                    $d->unidad = $r->unidad_co[$i];
                    $d->cantidad = $r->cantidad[$i];
                    $d->precio =  $r->subtotal[$i];
                    $d->id_producto = $producto->id;
                    $d->id_venta = $v->id;
                    $d->precio_producto_unitario = $r->precio[$i];
                    $d->costo_producto = $r->costop[$i];
                    //disminuir los productos

                    //buscar que producto es
                    $detalle = [
                        "product" => $producto->id_tugerente,
                        // "price" => $producto->precio_venta_con_factura,
                        "price" => $d->precio_producto_unitario,
                        "qty" => $d->cantidad,
                        "total" => $d->precio,
                    ];

                    $detalleMetodoPago = [
                        "Serial"    => $producto->id,
                        "Producto"  => $r->detalles[$i],
                        "Cantidad"  => $r->cantidad[$i],
                        "Precio"    => $r->subtotal[$i],
                        "Descuento" => 0,
                        "Total"     => $r->subtotal[$i] * $r->cantidad[$i]
                    ];

                    //descontar la cantidad de productos
                    $producto->cantidad -= $d->cantidad;
                    $producto->save();

                    $detalles[] = $detalle;
                    $detalleMetodoPagoQR[] = $detalleMetodoPago;

                    $d->save();
                }

                // $id_venta = $this->__storeTuGerente($r->total_en_bolivianos, $id_cliente, $detalles);
                $id_venta = 0;
                $v->id_venta = $id_venta;

                //metodo de pago QR /////////////////////////////////////////////////////////////
                $pago = Pago::create([
                    'estado' => 0,
                    'fecha_hora' => date('Y-m-d H:i:s'),
                    'monto_total' => $r->monto_total,
                    'tipo' => 'Pago Facil',
                    'nota_venta_id' => $v->id,
                ]);

                // generacion del QR /////////////////////////////////////////////////////////////
                $loClient = new Client();

                $laHeader = [
                    'Accept' => 'application/json'
                ];

                $laBody   = [
                    "tcCommerceID"          => "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c",
                    "tnMoneda"              => 2,
                    "tnTelefono"            => $r->telefono,
                    'tcNombreUsuario'       => $r->cliente,
                    'tnCiNit'               => $r->ci_cliente,
                    'tcNroPago'             => rand(123456789, 999999999),
                    "tnMontoClienteEmpresa" => $pago->monto_total,
                    "tcCorreo"              => $r->correo,
                    'tcUrlCallBack'         => "http://localhost:8000",
                    "tcUrlReturn"           => "http://localhost:8000",
                    'taPedidoDetalle'       => $detalleMetodoPagoQR
                ];

                $loResponse = $loClient->post("https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2", [
                    'headers' => $laHeader,
                    'json' => $laBody
                ]);


                $laResult = json_decode($loResponse->getBody()->getContents());

                $laValues = explode(";", $laResult->values)[1];

                $laQrImage = json_decode($laValues)->qrImage;

                // Decodifica el base64 para obtener los datos binarios
                $binaryData = base64_decode($laQrImage);

                // Genera un nombre de archivo único
                $fileName = time() . '.png';

                // Almacena los datos binarios en el bucket S3
                Storage::disk('s3')->put($fileName, $binaryData, 'public');

                // Obtiene la URL del archivo almacenado en S3
                $qrCodeUrl = Storage::disk('s3')->url($fileName);

                $v->pago_qr = $qrCodeUrl;

                // fin del metodo de pago y QR /////////////////////////////////////////////////////////////

                $v->save();
                DB::commit();
            });
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            // return back();
            throw ValidationException::withMessages([
                //meustra el eeroror del correo
                'errorXD' => 'Ocurrio un error inesperado, intentalo nuevamente!!!',
            ]);
        }


        $color = '';
        $mensaje = '';

        $color = true;
        $mensaje = '¡Venta realizada con éxito! Felicidades por cerrar la venta.';





        return redirect()->Route('Venta.index')
            ->with([
                'VentasRegistrada' => $mensaje,
                'estado' => $color,
            ]);
    }

    private function __storeClienteGerente($nombre, $nit)
    {
        return;
    }

    public function storeVentasGerente($total, $cliente, $detalles)
    {
        return;
    }


    public function getNroFactProducto($id_venta_tugerente)
    {
        return;
    }


    private function __storeTuGerente($total, $cliente, $detalles)
    {
        return;
    }



    public function verificarTugereteProd()
    {
        return;
    }

    public function getIdTuGerenteProductos($contador)
    {
        return;
    }



    public function deleteTuGerente(Request $r)
    {
        return;
    }


    private function __pruebaXD()
    {
        return;
    }

    public function show(Venta $venta)
    {
        return;
    }

    public function edit(Venta $venta)
    {
        //  dd($venta);
        $datos = DatosGeneral::where('id', $venta->id_datos_generales)->first();
        // dd($datos);
        //solo deberia devolver un dato con el qeu se guardo!!!

        $cliente = Cliente::where('ci', $venta->ci_cliente)->first();
        // dd($venta->ci_empleado);

        $venta = Venta::join('empleados as e', 'e.ci', '=', 'ventas.ci_empleado')
            ->where('id', $venta->id)->first();
        // dd(Empleado::get());
        $detalles = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
            ->join('proveedors as pv', 'pv.id', '=', 'p.id_proveedor')
            ->select('detalle_ventas.*', 'p.*', 'detalle_ventas.cantidad as cantidad_venta', 'pv.nombre_proveedor')
            ->where('id_venta', $venta->id)->get();
        // dd($detalles);

        return view('VistaVentas.edit', compact('cliente', 'datos', 'venta', 'detalles'));
    }

    public function update(Request $r, Venta $venta)
    {

        $c = Cliente::where('ci', $r->ci_cliente)->first();
        if ($c == null) {
            $c = new Cliente();
        }

        $c->ci = $r->ci_cliente;
        $c->nombre = $r->cliente;
        // $c->empresa =  $r->empresa;
        //$c->nit =  $r->nit;
        //$c->correo = $r->correo;
        $c->telefono =  $r->telefono;
        // $c->direccion = $r->direccion;
        $c->save();

        // dd($r);
        // $v = new Venta();
        $v = $venta;
        $v->monto_total = $r->monto_total;
        $v->fecha = date('Y-m-d'); //hacerlo automatico
        $v->hora = date('H:i:s');  //hacerlo automatico
        $v->ci_cliente = $r->ci_cliente;
        $v->ci_empleado = $r->ci_empleado; //dacar el nombre del empleado

        $v->descuento = $r->descuento;
        $v->total_en_bolivianos = $r->total_en_bolivianos;
        $v->total_en_dolares = $r->total_en_dolares;

        $v->save();


        // metodo 1, la de restaurante
        //si entonces no crear
        //no existe, entonces crear
        //eliminar los que ya no estan

        //metodo 2, sencilla elimnas y volver a crear
        $detall_antiguos = DetalleVenta::where('id_venta', $v->id)->get();
        foreach ($detall_antiguos as $det) {
            $producto = Producto::where('id', $det->id_producto)->first();
            $producto->cantidad += $det->cantidad;
            $producto->save();
            $det->delete();
        }


        //dd(count($r->cod_oem));
        //  falta cargar empres, nit , telefono
        for ($i = 0; $i < count($r->cod_oem); $i++) {
            $producto = Producto::where('cod_producto', $r->cod_oem[$i])->first();
            $d = new DetalleVenta();
            $d->detalles = $r->detalles[$i];
            $d->unidad = $r->unidad_co[$i];
            $d->cantidad = $r->cantidad[$i];
            $d->precio =  $r->subtotal[$i];
            $d->costo_producto =  $r->costop[$i];
            $d->id_producto = $producto->id;
            $d->id_venta = $v->id;
            $d->precio_producto_unitario = $r->precio[$i];
            $d->save();

            //restar de productos que se esta vendiendo/ id, cantidad a restar
            $producto->cantidad -= $d->cantidad;
            $producto->save();
        }


        $xd = DatosGeneral::where('id', $venta->id_datos_generales)->first();
        $xd->tipo_de_cambio = $r->tc;
        $xd->forma_pago = $r->fpago;
        $xd->cheque = $r->cheque;
        $xd->cuenta_bancaria = $r->cuenta;
        $xd->entrega = $r->entrega;
        $xd->nota = $r->nota;
        $xd->save();

        return redirect()->Route('Venta.index')
            ->with('success', 'Venta fue actualizada con exito');
    }

    public function destroy(Request $r, Venta $venta)
    {

        $detalles = DetalleVenta::where('id_venta', $venta->id)->get();

        foreach ($detalles as $d) {
            $p = Producto::where('id', $d->id_producto)->first();
            $p->cantidad += $d->cantidad;
            $p->save();
        }
        $venta->delete();
        return redirect()->route('Venta.index')->with('success', 'se elimino la venta ' . $venta->id . ' con exito');
    }

    //cotizaciones
    public function existeCotizar(Request $r)
    {
        //consulta de busqeiuda
        $co = Cotizacion::where('nro_coti', $r->valor)->first();
        // dd($co);
        $ban = false;
        if ($co != null) {
            // dd($co->nro_coti,$r->antes );
            if ($co->nro_coti !=  $r->antes) {
                // dd('entre!!');
                $ban = true;
            }
        }

        return response()->Json([
            "result" =>  $ban,
        ]);
    }

    public function existeCotizar2(Request $r)
    {
        return;
    }

    public function cotiMAyor()
    {
        $coti_may = 0;
        $nro_cotizacion = Cotizacion::get();
        foreach ($nro_cotizacion as $coti) {
            $cc = intval($coti->nro_coti);
            if ($cc > $coti_may)
                $coti_may = $cc;
        }
        $coti_may++;
        return $coti_may;
    }

    public function indexCotizar()
    {
        $nro_coti = Request('nro_coti');
        $empleado = Request('empleado');
        $cliente = Request('cliente');
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        $realizadas_en = Request('realizadas_en');
        $estado = Request('estado');
        $referencia = Request('referencia');
        $cotizaciones = Cotizacion::join('clientes as c', 'c.ci', '=', 'cotizacions.ci_cliente')
            ->join('empleados as e', 'e.ci', '=', 'cotizacions.ci_empleado')
            ->select('cotizacions.*', 'c.nombre as name_cliente', 'e.nombre as name_empleado')
            ->when(Request('nro_coti'), function ($q) {
                return $q->where('cotizacions.nro_coti', Request('nro_coti'));
            })
            ->when(Request('empleado'), function ($q) {
                // dd('Mauricio Guitierrez');
                if (is_numeric(Request('empleado'))) {
                    return $q->where('e.ci', Request('empleado'));
                } else {
                    return $q->where('e.nombre', 'like', '%' . Request('empleado') . '%');
                }
            })
            ->when(Request('cliente'), function ($q) {
                // dd('Mauricio Guitierrez');
                if (is_numeric(Request('cliente'))) {
                    return $q->where('c.ci', Request('cliente'));
                } else {
                    return $q->where('c.nombre', 'like', '%' . Request('cliente') . '%');
                }
            })
            ->when(Request('fecha_antes'), function ($q) {
                return $q->where('cotizacions.fecha_realizada', '>=', Request('fecha_antes'));
            })
            ->when(Request('fecha_hasta'), function ($q) {
                return $q->where('cotizacions.fecha_realizada', '<=', Request('fecha_hasta'));
            })
            ->when(Request('referencia'), function ($q) {

                return $q->where('cotizacions.referencia', 'like', '%' . Request('referencia') . '%');
            })
            ->orderByDesc('cotizacions.nro_coti')->paginate(50);


        $detalles_venta = DetalleCotizacion::get();

        // dd($detalles_venta);


        return view('VistaCotizacion.index2', compact(
            'cotizaciones',
            'detalles_venta',
            'nro_coti',
            'empleado',
            'cliente',
            'fecha_antes',
            'fecha_hasta',
            'referencia',
            'estado'
        ));
    }

    public function createCotizar()
    {
        $datos = DatosGeneral::first();
        $user = Auth::user()->id;
        // dd($user);
        $empleado = Empleado::join(
            'users',
            'users.id',
            '=',
            'empleados.id_usuario'
        )->select('empleados.*', 'users.nombre_usuario')
            ->where('id_usuario', $user)->first();
        $fe = date('Y-m-d');
        $fe2 = date('Y-m-d', strtotime("+7 day"));

        $coti_may = $this->cotiMAyor();

        return view('VistaCotizacion.create', compact('empleado', 'datos', 'fe', 'fe2', 'coti_may'));
    }

    public function storeCotizar(Request $r)
    {
        $r->validate([
            'ci_empleado' => 'required',
            'ci_cliente' => 'required',
            'cliente' => 'required',
            'cotizacion' => 'required',
            'fecha_validez' => 'required',

        ]);

        $c = Cliente::where('ci', $r->ci_cliente)->first();
        if ($c == null) {
            $c = new Cliente();
        }

        $c->ci = $r->ci_cliente;
        $c->nombre = $r->cliente;
        $c->empresa =  $r->empresa;
        // $c->nit =  $r->nit;
        //$c->correo = $r->correo;
        $c->telefono =  $r->telefono;
        // $c->direccion = $r->direccion;
        $c->save();


        $xd = new DatosGeneral();
        $xd->tipo_de_cambio = $r->tc;
        $xd->forma_pago = $r->fpago;
        $xd->cheque = $r->cheque;
        $xd->cuenta_bancaria = $r->cuenta;
        $xd->entrega = $r->entrega;
        $xd->nota = $r->nota;
        $xd->save();

        $coti_may = $this->cotiMAyor(); //esto saca

        // dd($coti_may);
        $c = new Cotizacion();
        $ban = true;
        $aux = '';
        if ($r->cotizacion != $coti_may && (!is_null(Cotizacion::where('nro_coti', $r->cotizacion)->first()))) {
            $aux = $r->cotizacion;
            $r->cotizacion = $coti_may;
            $ban = false;
        }

        $c->nro_coti = $r->cotizacion;
        $c->monto_total = $r->monto_total;
        $c->fecha_realizada = $r->fecha_realizada;
        $c->fecha_validez = $r->fecha_validez;
        /// agregado las referencias y la atencion
        $c->referencia = $r->referencia;
        $c->atencion = $r->atencion;
        ////////////////////////////////////////////
        $c->hora = date('H:i:s');
        $c->estado = 'EN_COTIZACION';
        $c->ci_cliente = $r->ci_cliente;
        $c->ci_empleado = $r->ci_empleado; //dacar el nombre del empleado

        $c->descuento = $r->descuento;
        $c->total_en_bolivianos = $r->total_en_bolivianos;
        $c->total_en_dolares = $r->total_en_dolares;
        $c->id_datos = $xd->id;
        $c->save();

        //estados
        //en_Cotizacion  //quiere decir que esta en los dias validos
        //en venta       //ya se realizo su venta
        //agotado        //ya caduco su tui tiempo valido


        for ($i = 0; $i < count($r->cod_oem); $i++) {

            $id_producto = Producto::where('cod_producto', $r->cod_oem[$i])->first();
            $d = new DetalleCotizacion();
            $d->detalle_co = $r->detalles[$i];
            $d->cantidad = $r->cantidad[$i];
            $d->precio =  $r->subtotal[$i]; //este es el precio sub total!!!
            $d->id_producto = $id_producto->id;
            $d->id_cotizacion = $c->id;
            $d->precio_producto_unitario = $r->precio[$i]; //precio unitario!!
            $d->tiempo_entrega = $r->tiempo_entrega[$i];
            $d->unidad_co = $r->unidad_co[$i];
            $d->save();
        }

        // return redirect()->Route('Venta.index')
        //     ->with('VentasRegistrada','Venta Registrada con exito');

        if ($ban == true) {
            return redirect()->Route('Cotizar.index')->with(
                'CotizacionStore',
                'La cotizacion Nro: ' . $r->cotizacion . ' fue registrada con exito'
            );
        } else {
            return redirect()->Route('Cotizar.index')->with(
                'CotizacionStore',
                'La Cotizacion Nro: ' . $aux . ' acaba de ser usada, los datos cargados se crearon como la Cotizaconi Nro: ' . $r->cotizacion . '.'
            );
        }
    }


    public function storeDatosAPI(Request $r)
    {
        $len = count($r->id);


        for ($i = 0; $i < $len; $i++) {
            $xd = DatosGeneral::where('id', $r->id[$i])->first();
            if (isNull($xd))
                $xd = new DatosGeneral();

            $xd->tipo_de_cambio = $r->tipo_de_cambio[$i];
            $xd->forma_pago = $r->forma_pago[$i];
            $xd->cheque = $r->cheque[$i];
            $xd->cuenta_bancaria = $r->cuenta_bancaria[$i];
            $xd->entrega = $r->entrega[$i];
            $xd->nota = $r->nota[$i];
            $xd->save();
        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }

    public function storeCotizarAPI(Request $r)
    {
        // dd('llegue!!');
        // dd($r);
        $len = count($r->id);
        for ($i = 0; $i < $len; $i++) {

            $c =  Cotizacion::where('id', $r->id[$i])->first();
            if (is_null($c)) {
                $c = new Cotizacion();
            }

            $c->id = $r->id[$i];
            $c->nro_coti = $r->nro_coti[$i];
            $c->monto_total = $r->monto_total[$i];
            $c->fecha_validez = $r->fecha_validez[$i];
            $c->fecha_realizada = $r->fecha_realizada[$i];
            $c->hora = $r->hora[$i];
            $c->estado = $r->estado[$i];
            $c->ci_cliente = $r->ci_cliente[$i];
            $c->ci_empleado = $r->ci_empleado[$i];
            $c->total_en_bolivianos = $r->total_en_bolivianos[$i];
            $c->total_en_dolares = $r->total_en_dolares[$i];
            $c->descuento = $r->descuento[$i];
            $c->atencion = $r->atencion[$i];
            $c->referencia = $r->referencia[$i];
            $c->id_datos = $r->id_datos[$i];
            $c->save();
        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }

    public function storeVentasAPI(Request $r)
    {
        // dd('llegue!!');
        // dd($r);
        $len = count($r->id);
        for ($i = 0; $i < $len; $i++) {

            $c =  Venta::where('id', $r->id[$i])->first();
            if (is_null($c)) {
                $c = new Venta();
            }

            $c->id = $r->id[$i];
            $c->monto_total = $r->monto_total[$i];
            $c->fecha = $r->fecha[$i];
            $c->hora = $r->hora[$i];
            $c->ci_cliente = $r->ci_cliente[$i];
            $c->ci_empleado = $r->ci_empleado[$i];
            $c->total_en_bolivianos = $r->total_en_bolivianos[$i];
            $c->total_en_dolares = $r->total_en_dolares[$i];
            $c->descuento = $r->descuento[$i];
            $c->id_datos_generales = $r->id_datos_generales[$i];
            $c->save();
        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }


    public function storeDetalleCotizarAPI(Request $r)
    {
        // dd($r);
        $len = count($r->id);
        $unidad = "0";
        for ($i = 0; $i < $len; $i++) {
            $d =  DetalleCotizacion::where('id', $r->id[$i])->first();
            if (is_null($d)) {
                $d = new DetalleCotizacion();
            }
            $d->id = $r->id[$i];
            $d->cantidad = $r->cantidad[$i];
            $d->precio =  $r->precio[$i]; //este es el precio sub total!!!
            $d->id_producto = $r->id_producto[$i];
            //buscar la id donde ese nro_coti
            // $cotizacion = Cotizacion::where('id', $r->id_cotizacion[$i])->first();
            $d->id_cotizacion = $r->id_cotizacion[$i];
            $d->precio_producto_unitario = $r->precio_producto_unitario[$i]; //precio unitario!!
            $d->tiempo_entrega = $r->tiempo_entrega[$i];
            $d->detalle_co = $r->detalle_co[$i];
            $pp = Producto::where('id', $r->id_producto[$i])->first();
            $d->unidad_co = $pp->unidad;
            //    $d->unidad_co =$r->unidad_co[$i];
            // dd($unidad);
            $d->save();
        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Productos Cargados Correctamente');
    }



    public function storeDetalleVentasAPI(Request $r)
    {
        // dd($r);
        $len = count($r->id);
        $unidad = "0";
        for ($i = 0; $i < $len; $i++) {
            $d =  DetalleVenta::where('id', $r->id[$i])->first();
            if (is_null($d)) {
                $d = new DetalleVenta();
            }
            $d->id = $r->id[$i];
            $d->cantidad = $r->cantidad[$i];
            $d->precio =  $r->precio[$i]; //este es el precio sub total!!!
            $d->id_producto = $r->id_producto[$i];
            //buscar la id donde ese nro_coti
            // $cotizacion = Cotizacion::where('id', $r->id_cotizacion[$i])->first();
            $d->id_venta = $r->id_venta[$i];
            $d->precio_producto_unitario = $r->precio_producto_unitario[$i]; //precio unitario!!
            // $d->tiempo_entrega =$r->tiempo_entrega[$i];
            $d->detalles = $r->detalles[$i];
            $d->costo_producto = $r->costo_producto[$i];
            $pp = Producto::where('id', $r->id_producto[$i])->first();
            $d->unidad = $pp->unidad;
            //    $d->unidad_co =$r->unidad_co[$i];
            // dd($unidad);
            $d->save();
        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Productos Cargados Correctamente');
    }


    public function volverCotizacion(Cotizacion $cotizacion)
    {
        // dd($cotizacion);
        $cotizacion->estado = 'EN_COTIZACION';
        $cotizacion->save();
        return redirect()->route('Cotizar.index')->with('venta_cancelada', 'Venta Cancelada');
    }



    public function VentaCotizaCreate(Cotizacion $cotizacion)
    {
        //  dd($cotizacion);
        $cotizacion->estado = 'EN_VENTA';
        $cotizacion->save();

        $id_cot = $cotizacion->id;
        $datos = DatosGeneral::where('id', $cotizacion->id_datos)->first();
        $cliente = Cliente::where('ci', $cotizacion->ci_cliente)->first();

        //veriricar si el cliente esta en tu gerente

        $venta = Cotizacion::join('empleados as e', 'e.ci', '=', 'cotizacions.ci_empleado')
            ->where('id', $cotizacion->id)->first();

        // dd($venta);

        $detalles = DB::table('detalle_cotizacions as d')
            ->join('productos as p', 'p.id', '=', 'd.id_producto')
            ->where('id_cotizacion', $venta->id)
            ->select(
                'd.detalle_co as detalle',
                'd.cantidad as cantidad_venta',
                'd.precio',
                'd.precio_producto_unitario',
                'd.unidad_co',
                'p.*'
            )
            ->get();
        //  dd($detalles);
        // $mensaje = [];
        // $c = 0;
        // foreach ($detalles as $d) {
        //     // dd($d);
        //     $producto = Producto::where('id', $d->id)->first();
        //     //  dd($producto);
        //     if ($d->cantidad_venta >= $producto->cantidad)
        //         $mensaje[$c] = 'Solo quedan ' . $producto->cantidad . ' ' . $producto->unidad . ' disponibles en la fila ' . ($c + 1);
        //     else  $mensaje[$c] = '';
        //     $c++;
        // }



        return view('VistaVentas.createVentaCotiza', compact('cliente', 'datos', 'venta', 'detalles', 'id_cot'));
    }

    public function cotizarEdit(Cotizacion $co)
    {
        // $datos = DatosGeneral::get();
        $datos = Cotizacion::join('datos_generals as dg', 'dg.id', '=', 'cotizacions.id_datos')
            ->where('dg.id', '=', $co->id_datos)
            ->select('dg.*')->first();
        //solo deberia devolver un dato con el qeu se guardo!!!

        $cliente = Cliente::where('ci', $co->ci_cliente)->first();

        $cotizacion = Cotizacion::join('empleados as e', 'e.ci', '=', 'cotizacions.ci_empleado')
            ->where('id', $co->id)->first();

        $detalles = DetalleCotizacion::join('productos as p', 'p.id', '=', 'detalle_cotizacions.id_producto')
            ->select('detalle_cotizacions.*', 'p.*', 'detalle_cotizacions.cantidad as cantidad_venta')
            ->where('id_cotizacion', $co->id)->get();
        // dd($datos);

        return view('VistaCotizacion.edit', compact('cliente', 'datos', 'cotizacion', 'detalles'));
    }

    public function cotizarUpdate(Cotizacion $co, Request $r)
    {
        $cl = Cliente::where('ci', $r->ci_cliente)->first();
        if (is_null($cl)) {
            $cl = new Cliente();
        }

        $cl->ci = $r->ci_cliente;
        $cl->nombre = $r->cliente;
        $cl->empresa =  $r->empresa;
        // $c->nit =  $r->nit;
        //$c->correo = $r->correo;
        $cl->telefono =  $r->telefono;
        // $c->direccion = $r->direccion;
        $cl->save();

        // $xd = new datosgeneral();
        $xd = DatosGeneral::where('id', $co->id_datos)->first();
        // dd($xd);
        $xd->tipo_de_cambio = $r->tc;
        $xd->forma_pago = $r->fpago;
        $xd->cheque = $r->cheque;
        $xd->cuenta_bancaria = $r->cuenta;
        $xd->entrega = $r->entrega;
        $xd->nota = $r->nota;
        $xd->save();


        // $c = Cotizacion::where('id', $r->cotizacion)->first();
        // $c = new Cotizacion();

        $coti_may = $this->cotiMAyor(); //esto saca

        $ban = true;
        $aux = '';
        // dd($r);
        //validar bien lo de nro cotizacion
        if ($r->cotizacion != $co->nro_coti) {
            //preguntar si esta creada e nro_coti, esto ocurre si alguien lo crea la mismo tiempo
            if (!is_null(Cotizacion::where('nro_coti', $r->cotizacion)->first())) {
                $aux = $r->cotizacion;
                $r->cotizacion = $coti_may;
                $ban = false;
            }
        }


        $co->nro_coti = $r->cotizacion;
        $co->monto_total = $r->monto_total;
        $co->fecha_realizada = $r->fecha_realizada;
        $co->fecha_validez = $r->fecha_validez;
        /// agregado las referencias y la atencion
        $co->referencia = $r->referencia;
        $co->atencion = $r->atencion;
        ////////////////////////////////////////////
        $co->hora = date('H:i:s');
        $co->estado = 'EN_COTIZACION';
        $co->ci_cliente = $r->ci_cliente;
        $co->ci_empleado = $r->ci_empleado; //dacar el nombre del empleado

        $co->descuento = $r->descuento;
        $co->total_en_bolivianos = $r->total_en_bolivianos;
        $co->total_en_dolares = $r->total_en_dolares;

        $co->save();

        //estados
        //en_Cotizacion  //quiere decir que esta en los dias validos
        //en venta       //ya se realizo su venta
        //agotado        //ya caduco su tui tiempo valido

        //metodo 2, sencilla elimnas y volver a crear
        $detall_antiguos = DetalleCotizacion::where('id_cotizacion', $co->id)->get();
        foreach ($detall_antiguos as $det) {
            // $id_producto = Producto::where('id', $det->id_producto)->first();
            // $id_producto->cantidad += $det->cantidad;
            // $id_producto->save();
            $det->delete();
        }

        for ($i = 0; $i < count($r->cod_oem); $i++) {
            $id_producto = Producto::where('cod_producto', $r->cod_oem[$i])->first();
            $d = new DetalleCotizacion();
            $d->detalle_co = $r->detalles[$i];
            $d->cantidad = $r->cantidad[$i];
            $d->precio =  $r->subtotal[$i]; //este es el precio sub total!!!
            $d->id_producto = $id_producto->id;
            $d->id_cotizacion = $co->id;
            $d->precio_producto_unitario = $r->precio[$i]; //precio unitario!!
            $d->tiempo_entrega = $r->tiempo_entrega[$i];
            $d->unidad_co = $r->unidad_co[$i];
            $d->save();
        }

        if ($ban == true) {
            return redirect()->Route('Cotizar.index')->with(
                'CotizacionStore',
                'La Cotizacion Nro: ' . $r->cotizacion . ' fue actualizada con exito'
            );
        } else {
            return redirect()->Route('Cotizar.index')->with(
                'CotizacionStore',
                'La Cotizacion Nro: ' . $aux . ' acaba de ser usada, los datos cargados se crearon como la Cotizaconi Nro: ' . $r->cotizacion . '.'
            );
        }
    }

    public function cotizarDestroy(Cotizacion $cotizacion, Request $r)
    {
        // dd($r->id);
        $cotizacion = Cotizacion::find($r->id);
        $cotizacion->delete();
        return redirect()->route('Cotizar.index')->with('RegistroEliminado', $cotizacion->id);
    }

    //Funcion para generar pdf
    public function pdf_cotizacion(Cotizacion $co)
    {

        // dd($co);
        $datos = Cotizacion::join('datos_generals as dg', 'dg.id', '=', 'cotizacions.id_datos')
            ->where('dg.id', '=', $co->id_datos)
            ->select('dg.*')->first();

        $clientes = Cliente::get();
        $empleado = Empleado::join('users', 'users.id', '=', 'empleados.id_usuario')->get();

        $xd = DetalleCotizacion::join('productos as p', 'p.id', '=', 'detalle_cotizacions.id_producto')
            ->select('detalle_cotizacions.*', 'p.cod_oem')
            ->where('detalle_cotizacions.id_cotizacion', $co->id)->get();

        // dd($xd);

        $xds = Cotizacion::join('empleados as e', 'e.ci', '=', 'cotizacions.ci_empleado')
            ->join('users as u', 'u.id', '=', 'e.id_usuario')
            ->join('clientes as c', 'c.ci', '=', 'cotizacions.ci_cliente')
            ->select(
                'cotizacions.*',
                'e.nombre as nombre_empleado',
                'e.telefono as telefono_empleado',
                'u.correo_electronico',
                'c.nombre as nombre_cliente',
                'c.empresa'
            )
            ->where('cotizacions.id', $co->id)->first();
        // dd($xds);

        $pdf = PDF::loadView('VistaCotizacion.imprimir', ['xd' => $xd, 'xds' => $xds, 'clientes' => $clientes, 'empleado' => $empleado, 'datos' => $datos])
            ->setPaper('letter', 'portrait');
        $anio = date("Y");
        // dd($datos);
        return $pdf->stream('COTIZACION-Nro-' . $xds->nro_coti . '-' . $anio . '.pdf', ['Attachment' => 'true']);
    }

    public function pdf2(Venta $venta)
    {
        $datos = DatosGeneral::where('id', $venta->id_datos_generales)->first();
        $clientes = Cliente::get();

        $empleado = Empleado::join('users', 'users.id', '=', 'empleados.id_usuario')->get();

        $xd = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
            ->select('detalle_ventas.*', 'p.cod_oem')
            ->where('detalle_ventas.id_venta', $venta->id)->get();

        $xds = Venta::join('empleados as e', 'e.ci', '=', 'ventas.ci_empleado')
            ->join('users as u', 'u.id', '=', 'e.id_usuario')
            ->join('clientes as c', 'c.ci', '=', 'ventas.ci_cliente')
            ->select(
                'ventas.*',
                'e.nombre as nombre_empleado',
                'e.telefono as telefono_empleado',
                'u.correo_electronico',
                'c.nombre as nombre_cliente',
                'c.empresa'
            )
            ->where('ventas.id', $venta->id)->first();

        $pdf = PDF::loadView('VistaVentas.imprimir', ['xd' => $xd, 'xds' => $xds, 'clientes' => $clientes, 'empleado' => $empleado, 'datos' => $datos])
            ->setPaper('letter', 'portrait');
        $anio = date("Y");
        // dd($xds);
        return $pdf->stream('Orden-Venta-Nro-' . $xds->id . '-' . $anio . '.pdf', ['Attachment' => 'true']);
    }

    public function reporte1()
    {
        // $repo =Venta::join();
        $xd = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
            ->join('detalle_ventas.id_venta', '=', 'ventas.id')
            ->select('detalle_ventas.*', 'p.cod_oem', 'p.nombre as nombre_producto', 'p.unidad as unidad')->first();
        $ventas = Venta::join('detalle_ventas as dv', 'dv.id_venta', '=', 'ventas as v', 'v.id')->get();
        // dd($ventas);
        return view('pruebas.repo', compact('xd', 'ventas'));
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
}
