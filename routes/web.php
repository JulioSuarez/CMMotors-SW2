<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\PruebasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\RolController;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\DetalleVenta;
use App\Models\ExcelPrueba;
use App\Models\ExcelPruebaDos;
use App\Models\Producto;
use App\Models\Producto2;
use App\Models\ProductosVendido;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Counts;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Illuminate\Support\Facades\Http;

//rapidin
Route::get('/rapidin', [BackupController::class, 'compararCod_Gerente']);

Route::get('/descargarZip', [ProductoController::class, 'descargarZip'])->name('descargarZip');

Route::get('/descargarImagenesZip', [ProductoController::class, 'descargarImagenesZip'])->name('descargarImagenesZip');

Route::post('/homologarProducto',  [ProductoController::class, 'homologarProducto'])->name('homologarProducto');


//para haer pruebas
Route::get('/nazeeCoti',  [BackupController::class, 'verificarCotizacion']);
Route::get('/nazeeProd',  [BackupController::class, 'verificarProductos']);

Route::get('/holaxd', function () {

    $numeroRandom = rand(1, 30);
    $fecha = '2023-12-' . $numeroRandom;
    $venta = Venta::get();
    foreach ($venta as $v) {
        $v->fecha = $fecha;
        $v->save();
    }
    // $jsonString = file_get_contents(public_path('js/backupxd/ventasTuGerente.json'));
    // $jsonString = json_decode($jsonString, true);

    // $lista = [];
    // foreach ($jsonString['results'] as $key => $r) {
    //     $l['id_venta'] = $r['id'];
    //     $l['bill'] = $r['bill'];
    //     $lista[] = $l;
    // }
    // // dd($lista);
    // //buscar el id venta en la venta
    // foreach ($lista as $key => $li) {
    //     $v = Venta::where('id_venta', $li['id_venta'])->first();
    //     if (!is_null($v)) {
    //         if($v->nro_factura == 0){
    //             $v->nro_factura = $li['bill'];
    //             $v->save();
    //         }
    //     }else{
    //         dd('es null en '. $li['id_venta']);
    //     }
    // }
    // dd('fin xd d');
});




Route::get('/cod_oem_repetido', function () {

    $productos = Producto::get();
    // Tu array existente
    $miArray = [];
    foreach ($productos as $p) {

        // Verificar si el elemento ya está en el array
        if (!in_array($p->tienda, $miArray)) {
            // Agregar el elemento solo si no existe
            $miArray[] = $p->tienda;
        }

    }
    dd($miArray);

    //verificar si el cod_produ esta en el excel
    // $productos = Producto::get();
    // $productitos = [];
    // $c=0;
    // foreach ($productos as $p) {
    //     //es el mismo
    //     if($p->cod_oem != $p->cod_producto)

    //     $prod = ExcelPrueba::where('cod_oem', $p->cod_producto)->first();
    //     if(!is_null($prod)){
    //         dd('excel:',$prod,'cmmortrs:',$p);
    //         $c++;
    //     }
    // }
    // dd('no hay nada',$c);

    // $productos = ExcelPrueba::wherw

    // $productosRepetidos = DB::table('excel_pruebas')
    // ->select('cod_producto', DB::raw('COUNT(*) as cantidad'))
    // ->groupBy('cod_producto')
    // ->havingRaw('COUNT(*) > 1')
    // ->get();

    // dd($productosRepetidos);
    // $productosXD =[];
    // $productos = ExcelPrueba::get();
    //     $productosXD =[];
    //     foreach ($productos as $p) {
    //             // dd( $p);
    //             if(is_null($p->precio_compra )){
    //                 $productosXD[] = $p->cod_producto;

    //             }
    //     }

    // $tiendas = [];
    // $productos = Producto::get();
    // foreach ($productos as $p) {
    //     if (!in_array($p->tienda, $tiendas)) {
    //         // array_push($tiendas, $p->tienda);
    //         $tiendas[] = $p->tienda;
    //     }
    // }

    //comparar repetidos

    return redirect()->Route('Dashboard');
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//restaruar productos
Route::get('/restaurarProductos/index', function () {
    return view('VistasRol.restaurarProductos');
})->name('restaurarProductos.index');

Route::post('/CargarATugerente', [BackupController::class, 'CargarATugerente'])->name('CargarATugerente');
Route::post('/RestaurarProductoGen', [BackupController::class, 'RestaurarProductoTuGenrente'])->name('RestaurarProductoGerente');
Route::post('/RestaurarProducto', [BackupController::class, 'RestaurarProducto'])->name('RestaurarProducto');
Route::post('/actualizarIdProducto', [BackupController::class, 'actualizarIdProducto'])->name('actualizarIdProducto');

Route::get('/RestaurarCliente', [BackupController::class, 'RestaurarCliente']);
Route::get('/RestaurarPV', [BackupController::class, 'RestaurarProv'])->name('RestaurarProveedor');
Route::get('/RestaurarDatosG', [BackupController::class, 'RestaurarDatosG']);
Route::get('/RestaurarCotizaciones', [BackupController::class, 'RestaurarCotizaciones']);
Route::get('/RestaurarVentas', [BackupController::class, 'RestaurarVentas']);


// Route::get('/VerificarVentas', [BackupController::class, 'VerificarVentas']);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/', function () {
    $productos = Producto::get();
    return redirect()->Route('Dashboard');
})->middleware('auth');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/prueba', function () {
    return view('prueba');
});

Route::get('/prueba2', function () {
    $productos = Producto::get();
    foreach ($productos as $p ) {
        if($p->nombre == null){
            dd($p);
        }
    }
    dd('no hay nada');
});
// Route::post('/prueba', [ProductoController::class, 'show'])->name('prueba.show');



Route::post('/cargarIdproducto', [BackupController::class, 'cargarIdproducto'])->name('cargarIdproducto');
Route::get('/prueba3', [BackupController::class, 'prueba3']);
Route::get('/ActualizarCliente', [ClienteController::class, 'ActualizarCliente']);

Route::delete('/deleteTuGerente', [VentasController::class, 'deleteTuGerente'])->name('deleteTuGerente');




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// pruebas
Route::get('/prueba', function () {
    return view('prueba');
})->middleware('rol_admin');
// Route::post('/prueba', [VentasController::class, 'existeCotizar2'])->name('prueba_post')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//login, inicio de sesio
Route::get('Login', [AuthController::class, 'login'])
    ->name('Login')->middleware('guest');
Route::post('Login', [AuthController::class, 'loginStore'])
    ->name('LoginStore');
Route::get('Dashboard', [AuthController::class, 'dashboard'])
    ->name('Dashboard')->middleware('auth');
Route::post('Logout', [AuthController::class, 'logout'])
    ->name('Logout')->middleware('auth');
/////////////////PRUEBAS
Route::get('pruebas', [PruebasController::class, 'index'])->name('template')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('Cliente', ClienteController::class)
    ->Parameters(['Cliente' => 'cliente'])->names('Cliente')->middleware('auth');
Route::post('buscarCliente', [ClienteController::class, 'buscarCliente'])->name('buscarCliente');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('cliente_pdf', [ClienteController::class, 'cliente_pdf'])->name('cliente_pdf')->middleware('auth');
Route::get('empleado_pdf', [EmpleadoController::class, 'empleado_pdf'])->name('empleado_pdf')->middleware('auth');
Route::get('proveedor_pdf', [ProveedorController::class, 'proveedor_pdf'])->name('proveedor_pdf')->middleware('auth');
// Route::get('lista', [ClienteController::class, 'variables'])->name('lista')->middleware('auth');
Route::post('Existe_Cliente', [ClienteController::class, 'existeCliente'])->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('Empleado', EmpleadoController::class)->except(['show'])
    ->Parameters(['Empleado' => 'empleado'])->names('Empleado')->middleware('auth')->middleware('rol_admin');
// Route::post('Empleado',[EmpleadoController::class,'store'])
// ->name('Empleado.store')->middleware('auth');
Route::post('Existe_ci', [EmpleadoController::class, 'ExisteEmpleado'])->middleware('auth');
Route::post('Existe_usuario', [EmpleadoController::class, 'ExisteUsuario'])->middleware('auth')->name('Existe_usuario');
Route::post('Existe_correo', [EmpleadoController::class, 'ExisteCorreo'])->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('Producto', ProductoController::class)
    ->Parameters(['Producto' => 'p'])->names('Producto')->except(['destroy', 'edit'])->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Producto/{p}/edit', [ProductoController::class, 'edit'])
    ->name('Producto.edit')->middleware('auth')->middleware('rol_admin');
// Route::put('Producto/{p}', [ProductoController::class, 'update'])
//     ->name('Producto.update')->middleware('auth')->middleware('rol_admin');
Route::delete('Producto/{p}', [ProductoController::class, 'destroy'])
    ->name('Producto.destroy')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Descargar/{p}', [ProductoController::class, 'descargar'])->middleware('auth')->name('Descargar');
Route::post('buscarProducto', [ProductoController::class, 'buscarProducto'])->middleware('auth');
Route::post('buscarProductoNombre', [ProductoController::class, 'buscarProductoNombre'])->middleware('auth');
Route::post('ExisteProducto', [ProductoController::class, 'ExisteProductor'])->middleware('auth');
//------------------------------------------------------------------------------------------------------------------------------------------//
Route::get('CargarApiCliente', function () {
    return view('backup_todo.cargarCliente');
})->middleware('auth')->name('CargarApiCliente');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiProducto', function () {
    return view('backup_todo.cargarProducto');
})->middleware('auth')->name('CargarApiProducto');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiProveedor', function () {
    return view('backup_todo.cargarProveedor');
})->middleware('auth')->name('CargarApiProveedor');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiDatosGenerales', function () {
    return view('backup_todo.cargarDatosGenerales');
})->middleware('auth')->name('CargarApiDatosGenerales');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiCotizacion', function () {
    return view('backup_todo.cargarCotizacion');
})->middleware('auth')->name('CargarApiCotizacion');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiDetalleCotizacion', function () {
    return view('backup_todo.cargarDetalleCotizacion');
})->middleware('auth')->name('CargarApiDetalleCotizacion');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiVentas', function () {
    return view('backup_todo.cargarVentas');
})->middleware('auth')->name('CargarApiVentas');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('CargarApiDetalleVentas', function () {
    return view('backup_todo.cargarDetalleVentas');
})->middleware('auth')->name('CargarApiDetalleVentas');
//------------------------------------------------------------------------------------------------------------------------------------------//
Route::post('Productos/storexd', [ProductoController::class, 'storexd'])
    ->name('Producto.storexd')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('Cliente/storexd', [ClienteController::class, 'storexd'])
    ->name('Cliente.storexd')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('Proveedor', ProveedorController::class)->except(['show,index'])
    ->Parameters(['Proveedor' => 'p'])->names('Proveedor')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Proveedor', [ProveedorController::class, 'index'])
    ->name('Proveedor.index')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('ExisteProveedor', [ProveedorController::class, 'ExisteProveedor'])->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//PARA QUE PROVEEDOR 2
// Route::post('ProveedorStore', [ProveedorController::class, 'store2'])->name('Proveedor.store2')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::resource('Venta', VentasController::class)
    ->Parameters(['Venta' => 'venta'])->names('Venta')->middleware('auth');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Venta/Cotizacion{cotizacion}/create', [VentasController::class, 'VentaCotizaCreate'])
    ->name('Venta.createVentaCoti')->middleware('auth'); //pasacar cotizacion a venta

Route::get('ConsultarVentas/', [VentasController::class, 'consultarVentas'])
    ->name('Venta.ConsultarVentas')->middleware('auth');

Route::put('volverCotizacion/{cotizacion}', [VentasController::class, 'volverCotizacion'])
    ->name('Venta.volverCotizacion')->middleware('auth');
Route::post('existeCotizar', [VentasController::class, 'existeCotizar'])->middleware('auth');
Route::post('Venta/Create/Refresh/{venta}', [VentasController::class, 'storeVolverASubir'])
    ->name('Venta.Refresh')->middleware('auth');


Route::post('Venta/Create/RefreshXD/{venta}', [VentasController::class, 'storeVolverASubirXD']);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Route::post('Venta/Cotizacion{cotizacion}/create', [VentasController::class, 'storeVentaCotiza'])
//     ->name('Venta.update')->middleware('auth')->middleware('ventasStore');
/*
Route::get('Venta/{venta}/pdf2', [VentasController::class, 'pdf2'])
    ->name('Venta.pdf2')->middleware('auth');

    */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('GetProductosxd', [PruebasController::class, 'GetProductosxd'])
    ->name('GetProductosxd')->middleware('auth');
Route::get('ListaProductos', [ProductoController::class, 'ListaProductos'])
    ->name('ListaProductos')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('ListaProductosi', [ProductoController::class, 'ListaProductosi'])
    ->name('ListaProductosi')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('reporte', [PruebasController::class, 'reporte'])
    ->name('reporte')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('reporte/fecha', [VentasController::class, 'reporteVentasFecha'])
    ->name('reporte.fecha')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('ventas.utilidades', [VentasController::class, 'ventasUtilidades'])
    ->name('ventas.utilidades')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////imprimir factura//////
Route::get('Venta/{venta}/pdf', [VentasController::class, 'pdf2'])
    ->name('Venta.pdf')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Cotizar', [VentasController::class, 'indexCotizar'])
    ->name('Cotizar.index')->middleware('auth');
Route::get('Cotizar/create', [VentasController::class, 'createCotizar'])
    ->name('Cotizar.create')->middleware('auth');
Route::post('Cotizar/store', [VentasController::class, 'storeCotizar'])
    ->name('Cotizar.store')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Route::post('Cotizar/storeAPI', [VentasController::class, 'storeCotizarAPI'])
//     ->name('Cotizar.storeAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('Cotizar/storeCotizarAPI', [VentasController::class, 'storeCotizarAPI'])
    ->name('storeCotizarAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('Ventas/storeVentasAPI', [VentasController::class, 'storeVentasAPI'])
    ->name('storeVentasAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('Cotizar/storeDetalleCotizarAPI', [VentasController::class, 'storeDetalleCotizarAPI'])
    ->name('storeDetalleCotizarAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('Ventas/storeDetalleVentasAPI', [VentasController::class, 'storeDetalleVentasAPI'])
    ->name('storeDetalleVentasAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('storeDatosAPI', [VentasController::class, 'storeDatosAPI'])
    ->name('storeDatosAPI')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('Cotizar/{co}/edit', [VentasController::class, 'cotizarEdit'])
    ->name('Cotizar.edit')->middleware('auth')->middleware('rol_admin');
Route::put('Cotizar/{co}/update', [VentasController::class, 'cotizarUpdate'])
    ->name('Cotizar.update')->middleware('auth')->middleware('rol_admin');
Route::delete('Cotizar/{co}/delete', [VentasController::class, 'cotizarDestroy'])
    ->name('Cotizar.delete')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////imprimir Cotizacion//////
Route::get('Cotizar/{co}/pdf', [VentasController::class, 'pdf_cotizacion'])
    ->name('Cotizar.pdf')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ruta de prueba julico
Route::post('myurl', [AuthController::class, 'show'])->middleware('auth');
Route::get('/navegador', [ProductoController::class, 'navar'])->name('navegador')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// ruta de roles by Julico
Route::resource('Rol', RolController::class)->except(['show'])->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//rutas de PERMISOS
Route::get('Permisos', [RolController::class, 'crearPermisos'])->name('Permiso.create')->middleware('auth')->middleware('rol_admin');
Route::post('Permisos', [RolController::class, 'storePermisos'])->name('Permiso.store')->middleware('auth')->middleware('rol_admin');
Route::get('Permisos/{rol}/edit', [RolController::class, 'editPermisos'])->name('Permiso.edit')->middleware('auth')->middleware('rol_admin');
Route::put('Permisos/{rol}', [RolController::class, 'updatePermisos'])->name('Permiso.update')->middleware('auth')->middleware('rol_admin');
Route::delete('Permisos/{rol}', [RolController::class, 'deletePermisos'])->name('Permiso.deletePermisos')->middleware('auth')
    ->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//descargas
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('descargas/{id}', [PruebasController::class, 'descargasxd'])->name('descargas')->middleware('auth');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//poner todos los productos con el estado Habilidato.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('producto.subirZip', [ProductoController::class, 'subirZip'])->name('producto.subirZip')->middleware('auth')->middleware('rol_admin');
Route::get('producto.deshabilitado', [ProductoController::class, 'deshabilitado'])->name('producto.deshabilitado')->middleware('auth')->middleware('rol_admin');
Route::post('producto/habilitado/{id}', [ProductoController::class, 'habilitar'])->name('producto.habilitado')->middleware('auth')->middleware('rol_admin');
Route::get('proveedor.deshabilitado', [ProveedorController::class, 'deshabilitadoIndex'])->name('proveedor.deshabilitado')->middleware('auth')->middleware('rol_admin');
Route::post('proveedor.habilitar/{p}', [ProveedorController::class, 'habilitar'])->name('proveedor.habilitar')->middleware('auth')->middleware('rol_admin');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//para cher backup
Route::post('HacerBackup', [AuthController::class, 'hacerBackup']);
Route::post('HacerBackup2', [AuthController::class, 'hacerBackup2'])->name('hacerBackup2');
Route::get('bk', [ProductoController::class, 'GetProductos'])->name('bk');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Route::get('/bk', function() {
//     // Artisan::call("backup:run --only-db");
//     // return dd(Artisan::output());
//     return view('VistaExport.loca');
// })->name('bk');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/exporta2', [AuthController::class, 'exporta2'])->name('exporta2');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/archivos', function () {
    return view('backup_archivos.archivos2');
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('facturar', [PruebasController::class, 'facturar'])->name('facturar');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('vista-importar', [ProductoController::class, 'vistaCargaMasiva'])->name('vista-importar');
Route::post('importar-productos-masivos', [ProductoController::class, 'cargaMasiva'])->name('importar-productos-masivos');


Route::get('exportar/producto/collection', [ProductoController::class, 'exportarCollection'])->name('exportar.producto.collection');
Route::get('exportar/producto/view', [ProductoController::class, 'exportarView'])->name('exportar.producto.view');
Route::post('import/producto', [ProductoController::class, 'importar'])->name('import.producto');
Route::post('importSegundarias', [ProductoController::class, 'importarSegundarias'])->name('import.segundarias');
Route::post('importarVerificar', [ProductoController::class, 'importarVerificar'])->name('importarVerificar');


//actualizar ubicacoin
Route::post('deshabilitarProducto', [ProductoController::class, 'deshabilitarProducto'])->name('deshabilitarProducto');
Route::post('actualizarProductoImport', [ProductoController::class, 'actualizarProductoImport'])->name('actualizarProductoImport');
