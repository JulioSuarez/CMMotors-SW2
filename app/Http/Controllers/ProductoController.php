<?php

namespace App\Http\Controllers;

use App\Exports\ExcelGeneralExport;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Proveedor;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cotizacion;
use App\Models\DatosGeneral;
use App\Models\DetalleCotizacion;

use App\Exports\ProductoExportCollection;
use App\Exports\ProductoExportView;
use App\Exports\VerificadorExport;
use App\Imports\ActualizarProductosImport;
use App\Imports\ActualizarUbicacionImport;
use App\Imports\ProductosImport;
use App\Imports\ProductoImport;
use App\Imports\DeshabilitarProducto;
use App\Imports\VerificadorImport;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use PDF;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code_prod = Request('code_prod');
        $nombre_prod = Request('nombre_prod');
        $proveedor = Request('proveedor');
        $ubicacion = Request('ubicacion');
        $tienda = Request('tienda');
        $marca = Request('marca');
        $stock_menores = Request('stock_menores');
        $mostrar_por = Request('mostrar_por');
        // $fecha_antes = Request('fecha_antes');
        // $fecha_hasta = Request('fecha_hasta');

        $productos = Producto::join('proveedors', 'proveedors.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'proveedors.nombre_proveedor', 'proveedors.proveedor_direccion', 'proveedors.nombre_proveedor_contacto', 'proveedors.proveedor_telefono')
            ->when(Request('code_prod'), function ($q) {
                return $q->where('productos.cod_oem', 'like', '%' . Request('code_prod') . '%')
                    ->orwhere('productos.cod_producto', 'like', '%' . Request('code_prod') . '%');
                // ->orwhere('productos.nombre', 'like', '%' . Request('code_prod') . '%');
            })
            ->when(Request('nombre_prod'), function ($q) {
                return $q->where('productos.nombre', 'like', '%' . Request('nombre_prod') . '%');
            })
            ->when(Request('proveedor'), function ($q) {
                return $q->where('proveedors.nombre_proveedor', 'like', '%' . Request('proveedor') . '%')
                    ->orwhere('proveedors.nit', Request('proveedor'));
            })
            ->when(Request('ubicacion'), function ($q) {
                return $q->where('productos.estante', Request('ubicacion'));
            })
            ->when(Request('tienda'), function ($q) {
                if (Request('tienda') == 'null') {
                    return $q;
                } else {
                    return $q->where('productos.tienda', Request('tienda'));
                }
            })
            ->when(Request('marca'), function ($q) {
                return $q->where('productos.marca', Request('marca'))
                    ->orwhere('productos.procedencia', Request('marca'));
            })
            ->when(Request('stock_menores'), function ($q) {
                if (Request('stock_menores') == 'null') {
                    return $q;
                } else {
                    return $q->where('productos.cantidad', '<=', Request('stock_menores'));
                }
            })
            ->when(Request('mostrar_por'), function ($q) {
                // dd('entre');

                if (Request('mostrar_por') == 'null') {
                    return $q;
                } else {
                    // return $q->where('productos.cantidad', '<=', Request('stock_menores'));
                    if(Request('mostrar_por') == '1'){
                        //registrado en tugerente
                         return $q->where('productos.id_tugerente','!=', '0');
                    }else{
                        if(Request('mostrar_por') == '2'){
                            return $q->where('productos.id_tugerente','0');
                        }else{
                            if(Request('mostrar_por') == '3'){
                                return $q->where('productos.nombre','')
                                        ->orWhere('productos.nombre',' ')
                                        ->orWhereNull('productos.nombre');
                            }else{
                                if(Request('mostrar_por') == '4'){
                                    return $q->where('productos.precio_venta_con_factura','0')
                                            ->orWhere('productos.precio_venta_sin_factura','0')
                                            ->orWhere('productos.precio_compra','0');
                                }else{
                                    return $q;
                                }
                            }
                        }
                    }
                }
            })
            ->orderByDesc('created_at')->paginate(50);

        foreach ($productos as $p) {
            if (strlen($p->nombre) > 35) {
                $p->nombre = substr($p->nombre, 0, 35) . '...';
                // dd('entree', $p->nombre);
            }
        }

        // dd($productos);

        return view('VistaProductos.index', compact('productos', 'code_prod', 'proveedor', 'ubicacion', 'tienda', 'marca', 'stock_menores', 'nombre_prod','mostrar_por'));
    }


    public function create()
    {
        //   $categorias = CategoriaProducto::get();
        $proveedores = Proveedor::where('estado', 'HABILITADO')->get();
        return view('VistaProductos.create', compact('proveedores'));
    }


    public function store(Request $r)
    {
        //validacoines
        // dd($r);
        //codigo sustittuo ahora es el codigo de producto
        $r->validate([
            'cod_oem' => 'required',
            'cod_producto' => 'required',
            'nombre' => 'required',
            'precio' => 'required',
            'precio_factura' => 'required',
            'precio_sin_factura' => 'required',
            'estante' => 'required',
            'cantidad' => 'required',
        ]);

        // dd();
        $nombre = '';
        try {
            DB::transaction(function () use ($r, &$nombre) {
                // dd($r);
                if ($r->hasFile('foto')) {
                    $file = $r->file('foto');
                    $destino = public_path('img/fotosProductos');
                    $fotos = time() . '-' . $file->getClientOriginalName();
                    $r->file('foto')->move($destino, $fotos);
                } else {
                    $fotos = "default.png"; //DEFAUDL
                }

                $p = new Producto();
                $p->cod_oem =  strtoupper($r->cod_oem);
                $p->cod_producto =  strtoupper($r->cod_producto);
                $p->nombre = strtoupper($r->nombre);
                // $p->descripcion = $r->nombre;
                $p->cantidad = $r->cantidad;
                $p->cant_minima = $r->cant_minima;
                $p->estado = $r->estado;
                $p->marca = strtoupper($r->marca);
                $p->procedencia = strtoupper($r->procedencia);
                $p->origen = strtoupper($r->origen);

                $p->precio_venta_con_factura = $r->precio_factura;
                $p->precio_venta_sin_factura = $r->precio_sin_factura;
                $p->precio_compra = $r->precio;
                $p->foto = $fotos;
                // if(is_null($r->fecha_expiracion)){
                //     $p->fecha_expiracion = "2100-09-26";
                // }else{
                // $p->fecha_expiracion = $r->fecha_expiracion;
                // }
                $p->tienda = strtoupper($r->tienda);
                $p->unidad = $r->unidad;
                $p->estante = strtoupper($r->estante);
                $p->id_proveedor = $r->proveedor;

                $nombre = $p->nombre;
                // $id_tugerente = $this->__storeGerente($r->cod_producto, $r->nombre);
                $id_tugerente = 0;
                $p->id_tugerente = $id_tugerente;
                $p->save();
                DB::commit();
            });
        } catch (\Exception $e) {
            //'llegue a exception mostrar todos los errores',
            // dd($e->getMessage());
            DB::rollBack();
            // return back()->withErrors(['errorG',$e->getMessage()]);
            throw ValidationException::withMessages([
                //meustra el eeroror del correo
                // 'errorG' => $e->getMessage(),
                'eroorConexion' => 'Ocurrió un error inesperado, no se pudo registrar el producto!!!'
            ]);
        }

        return redirect()->route('Producto.index')->with([
            'RegistroProducto' => $nombre . ' CREADO EXITOSAMENTE!!!',
            'estado' => 'bg-lime-500'
        ]);
    }


    public function homologarProducto(Request $r)
    {
        // // dd('llegamos, ', $r->all());
        // //validar que minimo tenga nombre y codigo
        // $producto = Producto::where('id', $r->prod_id)->first();
        // // dd($producto);
        // if (is_null($producto)) {
        //     throw ValidationException::withMessages([
        //         'EroorHomologacion' =>  'Error: producto no encontrado!',
        //     ]);
        // } else {
        //     if ($producto->nombre == '' || $producto->nombre == null) {
        //         throw ValidationException::withMessages([
        //             'EroorHomologacion' =>  $producto->cod_producto . ' No cuenta con nombre!',
        //         ]);
        //     } else {
        //         $producto->id_tugerente = $this->__storeGerente($producto->cod_producto, $producto->nombre);
        //         $producto->save();
        //         if ($producto->id_tugerente == 0)
        //             throw ValidationException::withMessages([
        //                 'EroorHomologacion' =>  $producto->cod_producto . 'NO SE PUDO HOMOLOGAR, INTENTE MAS TARDE!!!',
        //             ]);
        //     }
        // }

        // return redirect()->route('Producto.index')->with([
        //     'RegistroProducto' => $producto->cod_producto . ' HOMOLOGADO EXITOSAMENTE!!!',
        //     'estado' => 'bg-lime-500',
        // ]);
        return;
    }


    private function __storeGerente($code, $nombre)
    {
        // $id_producto = 0;
        // $response = Http::withHeaders([
        //     'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
        // ])->post('https://back.tugerente.com/v1/warehouses/product/', [
        //     "code" => $code,
        //     "name" => $nombre,
        //     "product_type" => "FINISHED",
        // ]);

        // // dd($response->json()['id']);
        // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
        //     $id_producto = $response->json()['id'];
        // }

        // return $id_producto;
        return;
    }


    //lista de unidades en tu gerente
    /* nombre | codigo
    unidades = 145015
    pza = 145287
    Kg = 148353
    Mts = 148351
    KIT =  148350
    LTS = 148352
    Par = 148378
    Servicio = 148398
    */

    //metodo para mostrar a que codigo de tuGerten le pertenece la unidad dada
    public static function getCodigoUnidad($nombre)
    {
        //hacer una lista de unidades
        $unidades = ['PZA', 'KG', 'MTS', 'LTS', 'PAR', 'KIT', 'SERVICIO', 'UNIDADES'];
        $codigos = ['145287', '148353', '148351', '148352', '148378', '148350', '148398', '145015'];
        for ($i = 0; $i < count($unidades); $i++) {
            if ($unidades[$i] ==  strtoupper($nombre)) {
                return $codigos[$i];
            }
        }
        return 0;
    }

    public function edit(Producto $p)
    {
        $p = Producto::where('productos.id', $p->id)
            ->join('proveedors as p', 'p.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'p.nombre_proveedor')
            ->first();
        // dd($p);
        $proveedores = Proveedor::where('estado', 'HABILITADO')->get();
        return view('VistaProductos.edit2', compact('p', 'proveedores'));
    }

    public function update(Request $r, Producto $p)
    {
        // dd('estampos en update');
        $r->validate([
            'cod_oem' => 'required',
            'cod_producto' => 'required',
            'nombre' => 'required',
            'precio' => 'required',
            'precio_factura' => 'required',
            'precio_sin_factura' => 'required',
            'estante' => 'required',
            'cantidad' => 'required',
        ]);



        // dd($r);
        if ($r->hasFile('foto')) {
            $file = $r->file('foto');
            $destino = public_path('img/fotosProductos/');
            $fotos = time() . '-' . $file->getClientOriginalName();
            $subirImagen = $r->file('foto')->move($destino, $fotos);
            $p->foto = $fotos;
        };

        $p->cod_oem = strtoupper($r->cod_oem);
        $p->cod_producto = strtoupper($r->cod_producto);
        $p->nombre = strtoupper($r->nombre);
        // $p->descripcion = $r->nombre;
        $p->cantidad = $r->cantidad;
        $p->cant_minima = $r->cant_minima;
        $p->estado = strtoupper($r->estado);
        $p->marca = strtoupper($r->marca);
        $p->procedencia = strtoupper($r->procedencia);
        $p->origen = strtoupper($r->origen);
        $p->precio_venta_con_factura = $r->precio_factura;
        $p->precio_venta_sin_factura = $r->precio_sin_factura;
        $p->precio_compra = $r->precio;
        // if(is_null($r->fecha_expiracion)){
        //     $p->fecha_expiracion = "2100-09-26";
        // }else{
        // $p->fecha_expiracion = $r->fecha_expiracion;
        // }
        $p->tienda = $r->tienda;
        $p->unidad = $r->unidad;
        $p->estante = strtoupper($r->estante);
        // $p->categoria = $r->categoria;
        $p->id_proveedor = $r->proveedor;
        $p->save();

        return redirect()->route('Producto.index')->with('UpdateProducto', $p->nombre . '  EDITADO EXITOSAMENTE!!!');
    }

    public function show(Producto $p)
    {
        $p = Producto::join('proveedors as pv', 'pv.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'pv.nombre_proveedor', 'pv.proveedor_telefono', 'pv.proveedor_correo')
            ->where('productos.id', $p->id)
            ->where('productos.estado', 'HABILITADO')
            ->first();
        // $p = Producto::where('cod_producto', $r->code)
        //     ->join('proveedors as pv', 'pv.id', '=', 'productos.id_proveedor')
        //     ->select('productos.*', 'pv.nombre_proveedor')
        //     ->where('productos.estado', 'HABILITADO')
        //     ->first();

        //     dd($p);

        return view('VistaProductos.show2', compact('p',));
    }

    public function showApi(Request $r)
    {
        $p = Producto::where('cod_producto', $r->code)
            ->join('proveedors as pv', 'pv.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'pv.nombre_proveedor')
            ->where('productos.estado', 'HABILITADO')
            ->first();

        // return $p;
          // Devolver una respuesta JSON
        return response()->json([
            'data' => $p,
        ]);
    }



    public function descargar(Producto $p)
    {
        $file = public_path("img/fotosProductos/" . $p->foto);
        return response()->download($file);
    }

    public function destroy(Producto $p)
    {
        $p->estado = 'DESHABILITADO';
        $p->save();
        return redirect()->route('Producto.index')->with('DeleteProducto', $p->nombre . '  DESHABILITADO!!!');
    }

    public function EliminarProducto(Producto $p)
    {
        $p->delete();
        return redirect()->route('Producto.index')->with('DeleteProducto', $p->nombre . '  Producto Eliminado exitosamente!!!');
    }

    public function habilitar(Producto $id)
    {
        // dd($id);
        $id->estado = 'HABILITADO';
        $id->save();
        return redirect()->route('Producto.index');
    }



    public function buscarProducto(Request $r)
    {
        //buscar solo con el codigo oem, que se aproxime al valor
        $productos = Producto::where(function ($query) use ($r) {
            $query->where('cod_oem', 'like', $r->valor . '%') //'%' .
                ->orwhere('cod_producto', 'like', $r->valor . '%');
        })->where('estado', 'HABILITADO')
            ->limit(7)->get();


        for ($i = 0; $i < Count($productos); $i++) {
            if ($productos[$i]->estado == 'DESHABILITADO') {
                unset($productos[$i]);
            }
        }

        return response()->Json([
            "estado" => 1,
            "productos" => $productos,
        ]);
    }

    public function buscarProductoNombre(Request $r)
    {

        $productos = Producto::where('nombre', 'like', '%' . $r->valor . '%')
            ->where('estado', 'HABILITADO')
            ->limit(7)->get();

        // for ($i = 0; $i < Count($productos); $i++) {
        //     if ($productos[$i]->estado == 'Deshabilitado') {
        //         unset($productos[$i]);
        //     }
        // }


        return response()->Json([
            "estado" => 1,
            "productos" => $productos,
        ]);
    }


    public function ExisteProductor(Request $r)
    {
        //consulta de busqeiuda
        $p = Producto::where('cod_oem', $r->valor)
            ->where('estado', 'HABILITADO')->first();

        if ($p != null) {
            $p = true;
        } else {
            $p = Producto::where('cod_producto', $r->valor)->first();
            if ($p != null) {
                $p = true;
            } else {
                $p = false;
            }
        }

        return response()->Json([
            "result" => $p,
        ]);
    }

    public function HayProductos(Request $r)
    {
        //consulta de busqeiuda
        $p = Producto::where('cod_producto', $r->code)
            ->where('estado', 'HABILITADO')->first();
        if ($r->cantidad > $p->cantidad) {
            return response()->Json([
                "result" => 'Solo quedan ' . $p->cantidad . ' unidades disponibles en la fila ',
            ]);
        } else {
            return response()->Json([
                "result" => 'hay producotos disponibles',
            ]);
        }
    }

    public function GetProductos()
    {
        $pr = Producto::get();
        $cl = Cliente::get();
        $pv = Proveedor::get();
        $e = Empleado::get();
        $v = Venta::get();
        $dv = DetalleVenta::get();
        $co = Cotizacion::get();
        $da = DatosGeneral::get();
        $dco = DetalleCotizacion::get();

        return response()->Json([
            // "Usuarios" => User::get(),
            // "Empleados" => Empleado::get(),
            "Clientes" => $cl,
            "Productos" => $pr,
            "Proveedores" => $pv,
            "Empleados" => $e,
            "Ventas" => $v,
            "DetallesVentas" => $dv,
            "DatosGenerales" => $da,
            "Cotizaciones" => $co,
            "DetallesCotizaciones" => $dco,

        ]);
        // dd($xD);
        // return view('VistaExport.loca',compact('xD'));


    }
    public function GetProductosJULIO()
    {
        $pr = Producto::get();
        $cl = Cliente::get();
        $pv = Proveedor::get();
        $e = Empleado::get();
        $v = Venta::get();
        $dv = DetalleVenta::get();
        $co = Cotizacion::get();
        $da = DatosGeneral::get();
        $dco = DetalleCotizacion::get();

        //return response()->Json([
        $xD = array([
            "Productos" => $pr,
            "Clientes" => $cl,
            "Proveedores" => $pv,
            "Empleados" => $e,
            "Ventas" => $v,
            "DetallesVentas" => $dv,
            "DatosGenerales" => $da,
            "Cotizaciones" => $co,
            "DetallesCotizaciones" => $dco,

        ]);
        // dd($xD);
        return view('VistaExport.loca', compact('xD'));
    }


    //visra index de deshabilitados
    public function deshabilitado()
    {
        $code_prod = Request('code_prod');
        $proveedor = Request('proveedor');
        $ubicacion = Request('ubicacion');
        $tienda = Request('tienda');
        $marca = Request('marca');
        $stock_menores = Request('stock_menores');
        // $fecha_antes = Request('fecha_antes');
        // $fecha_hasta = Request('fecha_hasta');

        $productos = Producto::join('proveedors', 'proveedors.id', '=', 'productos.id_proveedor')
            ->select('productos.*', 'proveedors.nombre_proveedor', 'proveedors.proveedor_direccion', 'proveedors.nombre_proveedor_contacto', 'proveedors.proveedor_telefono')
            ->when(Request('code_prod'), function ($q) {
                return $q->where('productos.cod_oem', Request('code_prod'))
                    ->orwhere('productos.cod_producto', Request('code_prod'))
                    ->orwhere('productos.nombre', 'like', '%' . Request('code_prod') . '%');
            })
            ->when(Request('proveedor'), function ($q) {
                return $q->where('proveedors.nombre_proveedor', 'like', '%' . Request('proveedor') . '%')
                    ->orwhere('proveedors.nit', Request('proveedor'));
            })
            ->when(Request('ubicacion'), function ($q) {
                return $q->where('productos.estante', Request('ubicacion'));
            })
            ->when(Request('tienda'), function ($q) {
                if (Request('tienda') == 'null') {
                    return $q;
                } else {
                    return $q->where('productos.tienda', Request('tienda'));
                }
            })
            ->when(Request('marca'), function ($q) {
                return $q->where('productos.marca', Request('marca'))
                    ->orwhere('productos.procedencia', Request('marca'));
            })
            ->when(Request('stock_menores'), function ($q) {
                if (Request('stock_menores') == 'null') {
                    return $q;
                } else {
                    return $q->where('productos.cantidad', '<=', Request('stock_menores'));
                }
            })
            // ->where('productos.estado', 'EliminarTuGerente')
            ->where('productos.estado', 'DESHABILITADO')
            ->orderBy('productos.cod_oem')->get();  //->paginate(50);

        $count = $productos->count();

        return view('VistaProductos.deshabilitados', compact('productos', 'code_prod', 'proveedor', 'ubicacion', 'tienda', 'marca', 'stock_menores', 'count'));
    }

    public function ListaProductos()
    {
        $productos = Producto::get();
        $pdf = PDF::loadView('VistaProductos.listaproductos', ['productos' => $productos])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        // dd($fecha);
        return $pdf->stream('Lista-de-Productos-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }

    //lista de productos con impouestos
    public function ListaProductosi()
    {
        $productos = Producto::get();
        $pdf = PDF::loadView('VistaProductos.listaproductosi', ['productos' => $productos])
            ->setPaper('letter', 'portrait');
        // dd($xds);
        $fecha = date('Y-m-d');
        // dd($fecha);
        return $pdf->stream('Lista-de-Productos-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }


    public function vistaCargaMasiva()
    {
        return view('VistaProductos.cargaMasiva');
    }


    public function cargaMasiva(Request $r)
    {
        $archivo = $r->file('archivo');
        //primero voy a verificar que no venga vacio
        if ($archivo) {
            // dd($archivo);
            Excel::import(new ProductosImport, $archivo);
            return redirect()->route('Producto.index')->with('RegistroProducto', 'Productos importados correctamente');
        } else {
            return redirect()->route('Producto.index')->with('RegistroProducto', 'No se ha seleccionado ningun archivo para importar');
        }
    }




    public function exportarCollection()
    {
        // return Excel::download(new  ProductoExportCollection, 'Productos.xlsx');
        return Excel::download(new  ExcelGeneralExport, 'Productos.xlsx');
    }

    public function exportarView()
    {
        return Excel::download(new  ProductoExportView, 'Productos.xlsx');
    }

    public function importar(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'documento' => 'required|mimes:xlsx,xls,csv'
        ]);

        // ini_set('max_execution_time', '-1');
        // set_time_limit(300000);
        $rowNumber = 1; // Inicializamos el contador de filas
        Excel::import(new ProductoImport($rowNumber), $request->file('documento'));
        return redirect()->route('vista-importar')->with('success', 'Productos importados con exito');
    }

    public function actualizarProductoImport(Request $request)
    {
        $rowNumber = 1; // Inicializamos el contador de filas
        Excel::import(new ActualizarUbicacionImport($rowNumber), $request->file('documento'));
        return redirect()->route('vista-importar')->with('success', 'Productos importados con exito');
    }

    public function importarSegundarias(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'documento' => 'required|mimes:xlsx,xls,csv'
        ]);
        Excel::import(new ActualizarProductosImport, $request->file('documento'));
        return redirect()->route('vista-importar')->with('success', 'Productos actualizados con exito');
    }

    public function deshabilitarProducto(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'documento' => 'required|mimes:xlsx,xls,csv'
        ]);
        Excel::import(new DeshabilitarProducto, $request->file('documento'));
        return redirect()->route('vista-importar')->with('success', 'Productos Deshabilitados con exito');
    }


    public function importarVerificar(Request $request)
    {
        Excel::import(new VerificadorImport, $request->file('documento'));
        dd('termine');
        return Excel::download(new  VerificadorExport, 'Productos.xlsx');

        // return redirect()->route('vista-importar')->with('success', 'Productos actualizados con exito');
    }

    public function descargarImagenesZip()
    {
        $files = glob(public_path('img/fotosProductos/*'));
        $zipname = 'imagenes.zip';
        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        return response()->download($zipname);
    }

    public function subirZip(Request $request)
    {

        $file = $request->file('zip_file');
        $destino = 'rar/';
        $nombre = $file->getClientOriginalName();
        $request->file('zip_file')->move($destino, $nombre);
        // dd($fotos);


        // Puedes generar una respuesta de éxito o redirigir a una página de confirmación
        return redirect()->back()->with('success', 'Archivo ZIP subido con éxito');
    }

    public function descargarZip()
    {
        $nombreArchivo = 'Arqui - Primer Parcial - Julio.rar';
        $rutaArchivo = public_path('rar/' . $nombreArchivo);

        if (file_exists($rutaArchivo)) {
            return response()->download($rutaArchivo, $nombreArchivo);
        } else {
            return redirect()->back()->with('error', 'El archivo no existe o ha sido eliminado.');
        }
    }
}
