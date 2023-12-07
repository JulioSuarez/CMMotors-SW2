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
use PDF;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Exception;

use function PHPUnit\Framework\isNull;

class VentasController extends Controller
{

    private $__apiKey = 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338';
    private $__urlApi = 'https://back.tugerente.com/';

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
        // // return response()->Json([
        // //     "estado" => 'success',
        // //     "mensaje" => 'Factura #33 realizada con exito',
        // //     "nro_factura" =>   33,
        // // ]);


        // set_time_limit(120);
        // // dd($venta);
        // //buscar sus detalles
        // $detventas = DetalleVenta::where('id_venta', $venta->id)->get();
        // // dd( $detventas);
        // $detalles = [];
        // foreach ($detventas as $d) {
        //     $producto = Producto::where('id', $d->id_producto)->first();
        //     $detalle = [
        //         "product" => $producto->id_tugerente,
        //         "price" => $d->precio_producto_unitario,
        //         "qty" => $d->cantidad,
        //         "total" => $d->precio, //cantidad * precio unitario
        //     ];
        //     $detalles[] = $detalle;
        // }
        // // dd($detalles);

        // $cliente = Cliente::where('ci', $venta->ci_cliente)->first();
        // // dd($cliente);
        // //verificar si el cliente tiene un id_cliente diferente de 0
        // if ($cliente->id_tugerete == 0) {
        //     //si es 0, entonces crear un nuevo cliente
        //     $cliente->id_tugerete = $this->__storeClienteGerente($cliente->nombre, $cliente->ci);
        //     $cliente->save();
        // }
        // // dd('entre a crear una nueva venta');
        // $id_venta = $this->__storeTuGerente($venta->monto_total, $cliente->id_tugerete, $detalles);
        // // $id_venta = 11228535;

        // // dd($venta);

        // //verificar si el id_venta es diferente de 1111
        // if ($id_venta == 0) {
        //     //si es 0, entonces no se pudo crear la venta
        //     // return redirect()->route('Venta.index')->with('error_gerente', 'No se pudo crear la factura, vuelve a intentarlo!');
        //     return response()->Json([
        //         "estado" => 'error',
        //         "mensaje" => 'Nro Venta #'.$venta->id.': No se pudo crear la factura, verifique si se Homologaron los productos seleccionados!',
        //         "nro_factura" => 0,
        //     ]);
        // } else {
        //     //buscar el nuro de factura
        //     $venta->nro_factura = $this->getNroFactProducto($id_venta );
        //     //ahora actualizar el id_venta de la venta que se subio
        //     $venta->id_venta = $id_venta;
        //     $venta->save();
        //     // return redirect()->route('Venta.index')->with('success', 'Factura realizada con exito');
        //     return response()->Json([
        //         "estado" => 'success',
        //         "mensaje" => 'Factura #'.$venta->nro_factura.' realizada con exito',
        //         "nro_factura" =>   $venta->nro_factura,
        //     ]);
        // }
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

                $xd = new DatosGeneral();
                $xd->tipo_de_cambio = $r->tc;
                $xd->forma_pago = $r->fpago;
                $xd->cheque = $r->cheque;
                $xd->cuenta_bancaria = $r->cuenta;
                $xd->entrega = $r->entrega;
                $xd->nota = $r->nota;
                $xd->save();


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
                $v->id_datos_generales = $xd->id;
                $v->id_venta = $id_venta;
                $v->save();

                // dd($r->nit);
                //dd(count($r->cod_oem));
                //  falta cargar empres, nit , telefono
                $detalles = [];
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

                    //descontar la cantidad de productos
                    $producto->cantidad -= $d->cantidad;
                    $producto->save();

                    $detalles[] = $detalle;

                    $d->save();
                }

                // $id_venta = $this->__storeTuGerente($r->total_en_bolivianos, $id_cliente, $detalles);
                $id_venta = 0;
                $v->id_venta = $id_venta;
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
        // if ($id_venta != 0) {
        //     $color = true;
        //     $mensaje = '¡Venta realizada con éxito! Felicidades por cerrar la venta.';
        // } else {
        //     $color = false;
        //     $mensaje = '¡Venta realizada con éxito!, pero no fue posible registrar la venta en tuGerente.com';
        // }
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
        // $response = Http::withHeaders([
        //     'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
        // ])->post('https://back.tugerente.com/v1/sales/customer/', [
        //     "name" => $nombre,
        //     "nit" => $nit,
        //     "payment_method" => 2,
        //     "reference_name" => $nombre,
        //     "contact_phone" => "70297978",
        //     "contact_phone_prefix" => "591",
        //     "country" => "BO",
        //     "document_type" => 5,
        // ]);

        // //  dd($response);
        // $id_cliente = 2809343;
        // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        //     $id_cliente = $response->json()['id'];
        // }
        // return $id_cliente;
        return;
    }

    public function storeVentasGerente($total, $cliente, $detalles)
    {
        // return $this->__storeTuGerente($total, $cliente, $detalles);
        return;
    }


    public function getNroFactProducto($id_venta_tugerente)
    {
        //     // dd('llegeu ',$id_venta_tugerente);
        //    $response = Http::withHeaders([
        //     'ApiKey' => $this->__apiKey,
        // ])->get($this->__urlApi . 'v1/sales/sale/'.$id_venta_tugerente, []);


        // // dd($response->json());
        // return $response->json()['bill'];
        return;
    }


    private function __storeTuGerente($total, $cliente, $detalles)
    {
        // // dd($total, $cliente, $detalles);
        // $response = Http::withHeaders([
        //     'ApiKey' => $this->__apiKey,
        // ])->post($this->__urlApi . 'v1/sales/sale/', [
        //     // "tenant_id" => 35344,
        //     // "code" => "40042",
        //     "payment_method" => 2,
        //     // "second_payment_method"=> null,
        //     // "third_payment_method"=> null,
        //     "warehouse" =>  48380,
        //     "customer" => $cliente, //2809343,
        //     "employee" => 604368,
        //     // "turn"=> null,
        //     // "currency" => 336916,
        //     // "sale_details_deleted"=> [],
        //     "sale_details" => $detalles,
        //     // "batch_detail_cards"=> [],
        //     // "output_warehouse"=> null,
        //     // "card_manager"=> null,
        //     // "amount_before_advance" => 64.0,
        //     // "motoclick_shipment"=> null,
        //     // "delivery"=> null,
        //     // "invoice_qr_code"=> "",
        //     // "invoice_or_actual_delivery_date"=> "2023-05-18",
        //     "comment" => "",
        //     "amount" => $total,
        //     "discount" => 0,
        //     "elaboration_date" => now(),
        //     "planned_delivery_date" => now(),
        //     "actual_delivery_date" => now(),
        //     "delivered" => true,
        //     // "bill"=> null,
        //     // "latitude"=> "",
        //     // "longitude"=> "",
        //     // "commission"=> null,
        //     // "no_discount_amount"=> "64.0000",
        //     "add_bill" => true,
        //     // "sale_type"=> null,
        //     // "batched"=> false,
        //     // "generated_on_new_pos"=> false,
        //     "margin_of_gain" => "100.0000",
        //     "with_email" => true,
        //     "email" => "ernest_eclm@hotmail.com",
        //     // "is_py"=> false,
        //     // "use_second_payment_method"=> false,
        //     // "first_paid_amount"=> null,
        //     // "second_paid_amount"=> null,
        //     // "is_total_advance"=> false,
        //     // "product_from_another_warehouse"=> false,
        //     // "credit_payments_with_multipago"=> false,
        //     // "amount_billed"=> "0.0000",
        //     // "stock_delivered"=> false,
        //     // "cashflow_generated"=> false,
        //     // "third_paid_amount"=> null,
        //     // "use_third_payment_method"=> false,
        //     // "coupon_amount"=> "0.0000",
        //     // "coupon_number"=> "",
        //     // "was_refunded"=> false,
        //     // "refund_date"=> null,
        //     // "nro_transaction"=> null,
        //     // "currency_type"=> null,
        //     // "bank"=> null,
        //     // "second_nro_transaction"=> "",
        //     // "second_currency_type"=> "",
        //     // "second_bank"=> "",
        //     // "third_nro_transaction"=> "",
        //     // "third_currency_type"=> "",
        //     // "third_bank"=> "",
        //     // "with_email"=> false,
        //     // "email"=> "",
        //     "billed" => true, //facturacion
        //     // "receipt_number"=> "",
        //     // "document_id"=> "fe3775fd-36b6-4bce-8c1e-3b27043c6240",
        //     // "extra_data"=> null,
        //     // "extra_data_for_bill"=> [],
        //     // "is_globalfood"=> false,
        //     // "latitud"=> null,
        //     // "longitud"=> null,
        //     // "transaction_mode" => "1",
        //     // "contract_number" => "0",
        //     // "discount_amount" => "0.0000",
        //     // "use_discount_amount"=> false,
        //     // "is_service_applied"=> false,
        //     // "service_amount" => "0.0000",
        //     // "state" => 0,
        //     // "sku"=> null,
        //     // "stage" => 1,
        //     // "is_send_wb"=> false,
        //     // "service_mode"=> null,
        //     // "card_number"=> null,
        //     // "second_card_manager"=> null,
        //     // "third_card_manager"=> null
        // ]);


        // // dd($response->json());
        // // dd($response);

        // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        //     // dd('si esta en estafo 200 o 201');
        //     return $response->json()['id'];
        // } else {
        //     // dd($response->getStatusCode());
        //     return 0;
        // }
        return;
    }



    public function verificarTugereteProd()
    {
        // //scar el json getProdyctos los idgerete de los productos

        //  $productosJson = file_get_contents(public_path('js/backupxd/productosTuGerente.json'));
        //  $productosJson= json_decode( $productosJson, true);

        // $listaIdGerente = [];
        //  foreach ($productosJson['results'] as $key => $prod) {
        //     // dd($prod);
        //     $listaIdGerente[] = $prod['id'];
        //  }

        // //  dd(count($listaIdGerente));

        //  //sacar los id_gerentes que no esten en los productos vendidos
        // $productos = Producto::where('id_tugerente', '!=',0)->get();
        // // dd(count($productos ), count($listaIdGerente));
        // $listaFinalxd = [];
        // foreach ($productos as $key => $p) {
        //    if(!in_array($p->id_tugerente,$listaIdGerente)){
        //         $listaFinalxd[] = $p->id_tugerente;
        //     }

        // }
        // // foreach ($listaIdGerente as $key => $ll) {
        // //     // if($key == 70 ){
        // //         $p = Producto::where('id_tugerente', $ll)->first();
        // //         // dd($p, $ll);
        // //     if(is_null($p)){
        // //         $aux['id'] = $ll;
        // //         $aux['key'] = $key;
        // //         $listaFinalxd[] = $aux;
        // //     }
        // //     // }
        // // }


        // dd( $listaFinalxd, $productos, $listaIdGerente);



    }

    public function getIdTuGerenteProductos($contador)
    {
        // //scar el json getProdyctos los idgerete de los productos

        //  $productosJson = file_get_contents(public_path('js/backupxd/Json_Cmmotors_04-10.json'));
        //  $productosJson= json_decode( $productosJson, true);
        // // dd($productosJson['Productos']);
        // $id_tugerente = [];
        // foreach ($productosJson['Productos'] as $producto) {
        //     $id_tugerente[] = $producto['id_producto'];
        // }
        // // dd($id_tugerente );

        // //sacar de la base los idgerete de los productos
        // $productos = Producto::where('id_tugerente', '!=',0)->get();
        // // dd($productos );
        // $id_prod_vendidos = [];
        // foreach ($productos as $key => $p) {
        //     $id_prod_vendidos[] = $p->id_tugerente;
        // }
        // // dd($id_prod_vendidos);

        // //crear la nueva lista donde estera la lista de prodcutos que se elimanarn
        // $listaFinal = [];
        // foreach ($id_tugerente as $key => $id) {
        //     // Verificar si el elemento ya está en el array
        //     if (!in_array($id, $id_prod_vendidos)) {
        //         $aux['id'] = $id;
        //         $listaFinal[] = $aux;
        //     }
        // }

        // $listaFinal2 = [];
        // foreach ($listaFinal as $key => $id) {
        //     if ( $key < $contador && $key >= ($contador - 2)) {
        //         $listaFinal2[] = $id;
        //     }
        // }
        // dd( $listaFinal2, $listaFinal);

        // // dd( count($id_tugerente), count($id_prod_vendidos) ,count($listaFinal)  ,  $listaFinal);
        // return $listaFinal2;

        return;
    }



    public function deleteTuGerente(Request $r)
    {
        // $listaProductos =  $this->verificarTugereteProd();
        // // $listaProductos =  $this->getIdTuGerenteProductos(2946);
        // // [
        // //     [
        // //         "id" => 3929679,
        // //     ],
        // //     [
        // //         "id" => 3929680,
        // //     ],
        // //     [
        // //         "id" => 3929681,
        // //     ]
        // // ],

        // //back.tugerente.com/v1/warehouses/product/0/
        // $response = Http::withHeaders([
        //     'ApiKey' => $this->__apiKey,
        // ])->delete($this->__urlApi . 'v1/warehouses/product/0/', [
        //     "products" => $listaProductos,
        //     // "products" => [
        //     //         [
        //     //             "id" => 3929679,
        //     //         ],
        //     //         [
        //     //             "id" => 3929680,
        //     //         ],
        //     //         [
        //     //             "id" => 3929682,
        //     //         ]
        //     //     ],
        //     // 'is_reversed' => false,
        // ]);
        // dd($response);



        // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        //     // dd('si esta en estafo 200 o 201');
        //     return $response->json()['id'];
        // } else {
        //     // dd($response->getStatusCode());
        //     return 0;
        // }
        return;
    }


    private function __pruebaXD()
    {
        // $response = Http::withHeaders([
        //     'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
        // ])->post('https://back.tugerente.com/v1/sales/sale/', []);

        // // dd($response);
        return;
    }

    public function show(Venta $venta)
    {
        dd($venta, 'estoy en show');

        // $ventas = DetalleVenta::join('productos as p', 'p.id', '=', 'detalle_ventas.id_producto')
        //     ->select('detalle_ventas.*', 'p.cod_oem', 'p.nombre as nombre_producto')
        //     ->where('detalle_ventas.id_venta', $venta->id)->get();


        // $venta = Venta::join('empleados as e', 'e.ci', '=', 'ventas.ci_empleado')
        //     ->join('clientes as c', 'c.ci', '=', 'ventas.ci_cliente')
        //     ->select(
        //         'ventas.*',
        //         'e.nombre as nombre_empleado',
        //         'c.nombre as nombre_cliente',
        //         'c.empresa'
        //     )
        //     ->where('ventas.id', $venta->id)->first();
        //  dd($venta);

        // return view('VistaVentas.show', compact('ventas', 'venta'));
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
        // dd('llegamos a destroy', $r, $venta);
        // dd('llegamos a facturacion');
        // $response = Http::withHeaders([
        //     'ApiKey' => $this->__apiKey,
        // ])->delete($this->__urlApi . 'v1/sales/sale/0/', [
        //     "sales" => [
        //         [
        //             "id" => $venta->id_venta,
        //         ],
        //     ],
        //     'is_reversed' => false,
        // ]);

        // // dd($response->json());
        // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        //     if ($r->tipo == 'facturacion') {
        //         $venta->id_venta = 0;
        //         $venta->nro_factura = 0;
        //         $venta->save();
        //         return redirect()->route('Venta.index')->with('success', 'se elimino la factura nro: ' . $venta->nro_factura . 'con exito');
        //     } else {
                $detalles = DetalleVenta::where('id_venta', $venta->id)->get();

                foreach ($detalles as $d) {
                    $p = Producto::where('id', $d->id_producto)->first();
                    $p->cantidad += $d->cantidad;
                    $p->save();
                }
                $venta->delete();
                return redirect()->route('Venta.index')->with('success', 'se elimino la venta ' . $venta->id . ' con exito');
        //     }
        // } else {
        //     //retornar con un error
        //     throw ValidationException::withMessages([
        //         //meustra el eeroror del correo
        //         // 'errorG' => $e->getMessage(),
        //         'eroorEliminacion' => 'Ocurrió un error inesperado, no se pudo eliminar la factura en TuGerente!!!'
        //     ]);
        // }
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
        } else {
            // dd('es nulo');
        }

        dd($ban);
        return view('prueba', compact('ban'));
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

        // return view('VistaCotizacion.index', compact('cotizaciones', 'detalles_venta','estado','empleado','cliente','fecha_antes','fecha_hasta'));
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

        //  $productos = Producto::get();
        //generar el numero de cotizacion

        // $nro_cotizacion = Cotizacion::get();
        $coti_may = $this->cotiMAyor();

        return view('VistaCotizacion.create', compact('empleado', 'datos', 'fe', 'fe2', 'coti_may'));
    }

    public function storeCotizar(Request $r)
    {
        // dd($r);
        //validaciones
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
        // dd('llegue!! xd');
        // dd($r);
        $len = count($r->id);
        for ($i = 0; $i < $len; $i++) {

            //aqui deberia ser con valores fijos la primera vez
            //porque no hay
            // $xd = new datosgeneral();
            // $xd->tipo_de_cambio = $r->tc;
            // $xd->forma_pago = $r->fpago;
            // $xd->cheque = $r->cheque;
            // $xd->cuenta_bancaria = $r->cuenta;
            // $xd->entrega = $r->entrega;
            // $xd->nota = $r->nota;
            // $xd->save();

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
            // $xd = new datosgeneral();

        }

        return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }

    public function storeVentasAPI(Request $r)
    {
        // dd('llegue!! xd');
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
            // $xd = new datosgeneral();

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
        $mensaje = [];
        $c = 0;
        foreach ($detalles as $d) {
            // dd($d);
            $producto = Producto::where('id', $d->id)->first();
            //  dd($producto);
            if ($d->cantidad_venta >= $producto->cantidad)
                $mensaje[$c] = 'Solo quedan ' . $producto->cantidad . ' ' . $producto->unidad . ' disponibles en la fila ' . ($c + 1);
            else  $mensaje[$c] = '';
            $c++;
        }



        return view('VistaVentas.createVentaCotiza', compact('cliente', 'datos', 'venta', 'detalles', 'id_cot', 'mensaje'));
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


        // // $xd = new datosgeneral();
        // $xd = DatosGeneral::first();
        // // if (is_null($xd)) {
        // //     $xd = new datosgeneral();
        // // }
        // $xd->tipo_de_cambio = $r->tc;
        // $xd->forma_pago = $r->fpago;
        // $xd->cheque = $r->cheque;
        // $xd->cuenta_bancaria = $r->cuenta;
        // $xd->entrega = $r->entrega;
        // $xd->nota = $r->nota;
        // $xd->save();

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
