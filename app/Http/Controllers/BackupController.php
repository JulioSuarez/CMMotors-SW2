<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentasController;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\DatosGeneral;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\DetalleVenta;
use App\Models\Empleado;
use App\Models\Venta;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //para poder usar el storage
use Illuminate\Http\File; //para crear un archivo
use Illuminate\Support\Facades\Http;

class BackupController extends Controller
{
    //valores se refiere a los valores id que tieen los cod_oem en
    // la base de ti GErnte estan registrar
    // public $ValoresProd = [];
    private $__jsonCMMotors;

    public function __construct()
    {
        //acceso al archivo json de cmmotors
        // $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
        $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
        $this->__jsonCMMotors = json_decode($jsonString, true);
    }

    //restaurar Empleados
    public function RestaurarEmpleado()
    {
        //traer los clientes del json
        $Empleados = $this->__jsonCMMotors['Empleados'];
        foreach ($Empleados as $E) {
            //bsucar por id_usuario al usuario en el json de backup 
            // y crearal aqui 
            if (is_null( Empleado::find($E['ci']))){
                Empleado::create($E);
            }
        }
        $ee = count(Empleado ::all() );
        return redirect()->route('Rol.index')->with($ee.' Empleados Cargados Correctamente');
    }


    //restaurar clientes
    public function RestaurarCliente()
    {
        //traer los clientes del json
        $clientes = $this->__jsonCMMotors['Clientes'];
        $cc = 0;
        foreach ($clientes as $c) {
            if (is_null( Cliente::find($c['ci']))){
                // dd('enter a crear xxd');
                Cliente::create($c);
            }
            $cc++;
        }
        // $cc = count(Cliente ::all() );
        // dd($cc);
      return redirect()->route('Rol.index')->with('Mensaje', $cc.' Clientes Cargados Correctamente y ');
    }

    public function RestaurarProv()
    {
        $proveedores = $this->__jsonCMMotors['Proveedores'];
        foreach ($proveedores as $r) {
            $p =  Proveedor::where('id', $r['id'])->first();
            // dd($r);
            if (is_null($p)) {
                Proveedor::create($r);
            }else{
                dd('si existe en proveedores',$p );
            }
        }
        $cc = count(Proveedor::get());
        return redirect()->route('Rol.index')->with('Mensaje', $cc.' Proveedores Cargados Correctamente');

        // return response()->json($data);
    }


    public function RestaurarProducto(){

        // dd('hola puto');
        $productos = $this->__jsonCMMotors['Productos'];
        // dd( $clientes);
        foreach ($productos as $r) {
            Producto::create($r);
        }
        $cc = count( Producto::get());
        return redirect()->route('Rol.index')->with('Mensaje',$cc . ' Productos Cargados Correctamente');
    }


    //esto es para restaurar productos del archivos json cuellar
    public function RestaurarProductoCuellar(){
        dd('hola puto wtf');
        $jsonString = file_get_contents(public_path('js/backupxd/cuellar.json'));
        $jsonCMMotors = json_decode($jsonString, true);


        $productos = $jsonCMMotors['Productos'];
        // dd( $clientes);
        foreach ($productos as $r) {
            $p = Producto::where('cod_oem', $r['cod_oem'])->first();
        if(is_null($p)){
            $p = new Producto();
            // $p->id = $r['id'];
            $p->cod_oem = $r['cod_oem'];
            $p->cod_sustituto = $r['cod_sustituto'];
            $p->nombre = $r['nombre'];
            $p->descripcion = $r['descripcion'];
            $p->cantidad = $r['cantidad'];
            $p->cant_minima = $r['cant_minima'];
            $p->estado = $r['estado'];
            $p->marca = $r['marca'];
            $p->procedencia = $r['procedencia'];
            $p->origen = $r['origen'];

            $p->precio_venta_con_factura = $r['precio_venta_con_factura'];
            $p->precio_venta_sin_factura = $r['precio_venta_sin_factura'];
            $p->precio_compra = $r['precio_compra'];
            $p->foto = $r['foto'];
            $p->fecha_expiracion = $r['fecha_expiracion'];
            $p->tienda = $r['tienda'];
            $p->unidad = $r['unidad'];
            $p->estante = $r['estante'];
            $p->id_proveedor = $r['id_proveedor'];
            // $nombre = $p->nombre;
            // $p->id_producto = 1111;
            $p->id_producto = $r['id_producto'];
            $p->save();

            }
        }
        // $cc = count( );
        return redirect()->route('Rol.index')->with('Mensaje', ' Productos Cargados Correctamente');
    }

    //aqui vamos a actualizar los id producto
    public function actualizarIdProducto()
    {
        dd('actualzia  produtos');
        //leer el json
        $jsonString = file_get_contents(public_path('js/backupxd/productosTuGerente.json'));
        $productosJson = json_decode($jsonString, true);
        // dd($productosJson['results']);
        foreach ($productosJson['results'] as $producto) {
            // dd($producto);
            //buscar el code oem en la base de datos ycambiar el id prodcuto

            if(!($producto['code'] == 'ADE-01' || $producto['code'] == 'ADJ-01')  ){
                $p = Producto::where('cod_oem',$producto['code'] )->first();
                if(is_null($p)){
                    dd('es null con el cod_oem'.$producto['code'],$producto);
                }else{
                    // dd('no el null bien',$p);
                    //reemplazar o verificar que el id_prodcuto sea diferente de 0
                    if($p->id_producto == 0){
                        $p->id_producto = $producto['id'];
                        $p->save();
                    }
                }
            }
        }

        return redirect()->route('Rol.index')->with('Mensaje', ' Productos actualizado Correctamente');

    }

    public function RestaurarProductoTuGenrente(Request $r)
    {
        dd($r, 'restaurar tugerten ');
        // dd('llegue  xd xd xd',$this->ValoresProd);
        //lee todo el backup de cmmotors
        $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
        // $jsonString = file_get_contents(public_path('js/backupxd/json_prueba.json'));

        $data = json_decode($jsonString, true);

        $result = $data['Productos'];
        // dd($result);
        //si ini es mayo a count
        $cc = count($result);
        // dd($cc);
        $ini =  $r->inicio;
        $fin =  $r->fin;
        if($ini >= $cc){
            $ini = $cc;
            $fin = $cc;
        }else{
            if($fin >= $cc){
                $fin = $cc;
            }
        }
        // dd($ini,$fin);
        $cc=0;
        for ($i=$ini; $i < $fin; $i++) {
            $p =  Producto::where('cod_oem', $result[$i]['cod_oem'])->first();
            // dd($p);
            if (is_null($p)) {
                // dd('es nulo')//;
                $p = new Producto();
            }

            // $p->id_producto = 1111;
            $unidad = ProductoController::getCodigoUnidad($result[$i]['unidad']);
            if($unidad == 0)
                dd('oye, unidad devolvio cero en',$p->id);
            $p->id_producto =  $this->__storeProdGerente($result[$i]['cod_oem'], $result[$i]['nombre'],$unidad);
            // $p->id_producto = 111;
            // dd('llegue',$p->id_producto);

            $p->id = $result[$i]['id'];
            $p->cod_oem = $result[$i]['cod_oem'];
            $p->cod_sustituto = $result[$i]['cod_sustituto'];
            $p->nombre = $result[$i]['nombre'];
            $p->descripcion = $result[$i]['nombre'];
            $p->cantidad = $result[$i]['cantidad'];
            $p->cant_minima = $result[$i]['cant_minima'];
            $p->estado = $result[$i]['estado'];
            $p->marca = $result[$i]['marca'];
            $p->procedencia = $result[$i]['procedencia'];
            $p->origen = $result[$i]['origen'];

            $p->precio_venta_con_factura = $result[$i]['precio_venta_con_factura'];
            $p->precio_venta_sin_factura = $result[$i]['precio_venta_sin_factura'];
            $p->precio_compra = $result[$i]['precio_compra'];

            $p->foto = $result[$i]['foto'];
            $p->fecha_expiracion = $result[$i]['fecha_expiracion'];
            $p->tienda = $result[$i]['tienda'];
            if ($result[$i]['cod_oem'] == 'SERV')
                $p->unidad = 'SERVICIO';
            else
                $p->unidad = $result[$i]['unidad'];
            $p->estante = strtoupper($result[$i]['estante']);
            $p->estado = $result[$i]['estado'];
            // $p->estado = "Habilitado"'];
            $p->id_proveedor = $result[$i]['id_proveedor'];
            // dd($p);
            $p->save();
            $cc++;
        }

        // dd('ninugna unidad es cero');
        // $cc = count(Producto::get());
        return redirect()->route('restaurarProductos.index')->with('Mensaje', $cc . ' Productos Cargados Correctamente');
    }

    public function CargarATugerente(Request $request){
        // $request->server->set('REQUEST_TIMEOUT', 300);
        set_time_limit(800);
        // dd('llegamos ', $r);
        $contador = 5251;
        $productos = Producto::get();
        // dd(count($productos));
        
        $listaPro = [];
        // $listoBase = [];
        $cc = 0;
        foreach ($productos as $key => $p) {
          
            if ( $key < $contador && $key >= $contador -  5251 && $p->nombre != '') {

                // dd('entre',$p->nombre, $p->id_tugerente );
                if($p->id_tugerente == 0){       
                    // dd('entre',$p );
                    //registtatr en nut gereten 
                    $cc++;
                        $listaPro[] = $p->cod_producto;
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
                        $listaUnidades = [
                            'UNIDADES'  =>  '145015',
                            'PZA'  =>  '145287',
                            'KILOGRAMOS'  =>  '148353',
                            'METROS'  =>  '148351',
                            'KIT'  =>  '148350',
                            'LITROS'  =>  '148352',
                            'PAR'  =>  '148378',
                            'SERVICIO'  =>  '148398',
                        ];

                        $unidad = $listaUnidades[$p->unidad];
                        // dd($unidad);


                        $response = Http::withHeaders([
                            'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
                        ])->post('https://back.tugerente.com/v1/warehouses/product/', [
                            "code" => $p->cod_producto,
                            "name" => $p->nombre,
                            "product_type" => "FINISHED",
                            "unit_measure" => $unidad,
                        ]);
                
                        // dd($response->json()['id']);
                        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                            $p->id_tugerente = $response->json()['id'];
                            $p->save();
                        }else{
                            dd('hubo un error al crear el producto, code:'.$p->cod_producto,$response->json(),$listaPro );
                        }
                
                }
            }

        }

        dd('regsitrados exitosamente: ' ,  $cc, $listaPro);   
    }

    public function RestaurarDatosG()
    {
        $datosG = $this->__jsonCMMotors['DatosGenerales'];
        // dd($datosG );
        foreach ($datosG as $r) {
            // dd($r);
            $xd = DatosGeneral::where('id', $r['id'])->first();
            if(!$xd){
                // dd('es null');
                $xd = new DatosGeneral();
            }
            $xd->id = $r['id'];
            $xd->tipo_de_cambio = $r['tipo_de_cambio'];
            $xd->forma_pago = $r['forma_pago'];
            $xd->cheque = $r['cheque'];
            $xd->cuenta_bancaria = $r['cuenta_bancaria'];
            $xd->entrega = $r['entrega'];
            $xd->nota = $r['nota'];
            $xd->save();
        }
        $cc = count(DatosGeneral::get());
        return redirect()->route('Rol.index')->with('Mensaje', $cc . ' Datos Generales Cargados Correctamente');
    } //end rest ventas



    public function RestaurarCotizaciones()
    {
        $this->__storeCotizarAPI();
        $cc = count(Cotizacion::get());

        $this->__storeDetalleCotizarAPI();
        $dd = count(DetalleCotizacion::get());
     
        $cc = count(Cotizacion::get());
        return redirect()->route('Rol.index')->with('Mensaje', $cc . 'Cotizaciones Cargados Correctamente y ' .$dd . ' detale de coti');
    } //end rest cotizacione


    private function __storeCotizarAPI()
    {
        $coti = $this->__jsonCMMotors['Cotizaciones'];
        // dd( $coti );
        foreach ($coti as $r) {

            Cotizacion::create($r);

            //verificar si existe
            // $c =  Cotizacion::where('id', $r['id'])->first();
            // if (is_null($c)) {
            //     // dd('es nulo');
            //     $c = new Cotizacion();
            // }

            // $cliente = Cliente::where('ci',$r['ci_cliente'])->first();
            // if( is_null($cliente)){
            //    dd('el cliente en unuevo,', $r['ci_cliente']);
            // }

            // $c->id = $r['id'];
            // $c->nro_coti = $r['nro_coti'];
            // $c->monto_total = $r['monto_total'];
            // $c->fecha_validez = $r['fecha_validez'];
            // $c->fecha_realizada = $r['fecha_realizada'];
            // $c->hora = $r['hora'];
            // $c->estado = $r['estado'];
            // $c->ci_cliente = $r['ci_cliente'];
            // $c->ci_empleado = $r['ci_empleado'];
            // $c->total_en_bolivianos = $r['total_en_bolivianos'];
            // $c->total_en_dolares = $r['total_en_dolares'];
            // $c->descuento = $r['descuento'];
            // $c->atencion = $r['atencion'];
            // $c->referencia = $r['referencia'];
            // $c->id_datos = $r['id_datos'];

            // $c->save();
        }
        // return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }


    private function __storeDetalleCotizarAPI()
    {
        $detalles = $this->__jsonCMMotors['DetallesCotizaciones'];
        // $unidad = "0";
        foreach ($detalles as $r) {
            DetalleCotizacion::create($r);
            //crear proudcto o si ya existe no hacer nada
            // $this->__verificarProducto($r['id_producto']);
            // dd($producto);
            // $d =  DetalleCotizacion::where('id', $r['id'])->first();
            // if (is_null($d)) {
            //     // dd('entre a es nuevo');
            //     $d = new DetalleCotizacion();
            // }
            // $d->id = $r['id'];
            // $d->cantidad = $r['cantidad'];
            // $d->precio =  $r['precio']; //este es el precio sub total!!!
            // $d->id_producto = $r['id_producto'];
            // $d->id_cotizacion = $r['id_cotizacion'];
            // $d->precio_producto_unitario = $r['precio_producto_unitario']; //precio unitario!!
            // $d->tiempo_entrega = $r['tiempo_entrega'];
            // $d->detalle_co = $r['detalle_co'];
            // $d->unidad_co = $r['unidad_co'];
            // $d->save();
        }

        //   return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Productos Cargados Correctamente');
    }

    private function __verificarProducto($id_producto){
        $productos = $this->__jsonCMMotors['Productos'];

        foreach ($productos as $i => $p) {
            if($p['id']  == $id_producto ){
                // dd('lo pille esta bien ', $p);
                //verificar si existe, 
                $prod = Producto::where('id',$p['id'] )->first();
                if(is_null( $prod)){
                    $p['id_tugerente'] = $p['id_producto'];
                    $p['cod_producto'] = $p['cod_sustituto'];
                    Producto::create($p);
                }
                return;
            }   
        }

        dd('no se encontro el producto');
    }


    public function RestaurarVentas()
    {
        // dd('llegamos');
        $this->__storeVentasAPI();
        $cc = count(Venta::get());
        // dd('se restauro ventas',$cc);
        // dd('llegamos ');
        
        $this->__storeDetalleVentasAPI();
        $dd = count(DetalleVenta::get());
        
        // dd('se restauro cotizaciones',$cc,$dd);


        return redirect()->route('Rol.index')->with('Mensaje', $cc . 'Ventas Cargados Correctamente y ' .$dd. ' detale de ventas');
    } //end rest ventas


    private function __storeVentasAPI()
    {
        // dd('llegue!! xd');
        $ventas = $this->__jsonCMMotors['Ventas'];
        // dd($ventas);
        foreach ($ventas as $r) {
            // dd($r);
            Venta::create($r);
            // $c =  Venta::where('id', $r['id'])->first();
            // if (is_null($c)) {
            //     $c = new Venta();
            // }else{
            //     dd('ay existe en venta',$c );
            // }

            // $c->id_venta = 0;
            // $c->id = $r['id'];
            // $c->monto_total = $r['monto_total'];
            // $c->fecha = $r['fecha'];
            // $c->hora = $r['hora'];
            // $c->ci_cliente = $r['ci_cliente'];
            // $c->ci_empleado = $r['ci_empleado'];
            // $c->total_en_bolivianos = $r['total_en_bolivianos'];
            // $c->total_en_dolares = $r['total_en_dolares'];
            // $c->descuento = $r['descuento'];
            // $c->id_datos_generales = $r['id_datos_generales'];
            // $c->id_venta = $r['id_venta'];
            // dd($c);
            // $c->save();
            // $xd = new datosgeneral();
            //enviar a
           
        }

        // return redirect()->route('Rol.index')->with('Registro_Exitoso', ' Datos Cargados Correctamente');
    }

    private function __storeDetalleVentasAPI()
    {
        // dd('llegamos a detalle s');
        //saca detalles de venta de backup
        $Dventas = $this->__jsonCMMotors['DetallesVentas'];
     
        foreach ($Dventas as $r) {
            DetalleVenta::create($r);
            // $this->__verificarProducto($r['id_producto']);
            //     $d =  DetalleVenta::where('id', $r['id'])->first();
            //     if (is_null($d)) {
            //         $d = new DetalleVenta();
            //     }else{
            //         dd('si existe en detalles ',$d );
            //     }
            //     $d->id = $r['id'];
            //     $d->detalles = $r['detalles'];
            //     $d->cantidad = $r['cantidad'];
            //     $d->precio =  $r['precio']; //este es el precio sub total!!!
            //     $d->id_producto = $r['id_producto'];
            //     $d->id_venta = $r['id_venta'];
            //     $d->precio_producto_unitario = $r['precio_producto_unitario']; //precio unitario!!
            //     $d->costo_producto = $r['costo_producto'];
            //     $d->unidad = $r['unidad'];
            //     $d->save();

        }

    }

    //sacar la id de producto, cero significa que no esta en tuGerente
    private function __sacarIdPro($cod_oem)
    {
        // dd($this->ValoresProd);
        $id_producto = 0;
        // $c=0;
        //consumir el archivo
        $jsonString = file_get_contents(public_path('restaurarProductos/productos.json'));
        $ValoresProd = json_decode($jsonString, true);
        foreach ($ValoresProd['Productos'] as $v) {
            // $c++;
            if ($cod_oem == $v['cod_oem']) {
                // dd('lo pille', $cod_oem,$v);
                $id_producto = $v['id_producto'];
                break;
            }
        }
        // dd($id_producto);
        return $id_producto;
    }

    //cargar un prooducto a tu geretne, y si el code ya existe, simplemetente devuevlo el di_prod
    private function __storeProdGerente($code, $nombre, $unidad)
    {
      //  dd('llegue a store prod gerente');
        $id_producto = $this->__sacarIdPro($code);
        // dd( $id_producto);
        if ($id_producto == 0) {
            // dd('es igual  cero '); //se debe crear uno nuevo, no esta e ntu geretne
            $response = Http::withHeaders([
                'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
            ])->post('https://back.tugerente.com/v1/warehouses/product/', [
                "code" => $code,
                "name" => $nombre,
                "product_type" => "FINISHED",
                "unit_measure" => $unidad,
            ]);
            // dd($response->json()['id']);
            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                return $response->json()['id'];
            } else {
                dd('hubo un error al crear el producto, code:' . $code . ' ' . $nombre);
            }

        }
        return $id_producto;
    }

    //restaurar ubicaciones de producto
    public function CambiarUbicacoin()
    {
        $jsonString = file_get_contents(public_path('js/backupxd/productos.json'));
        $productosJson = json_decode($jsonString, true);

        //   dd($productosJson['Productos']);
        // $ProductosNoGuardados = [];
        $c = 0;
        foreach ($productosJson['Productos'] as $prodjs) {
            // dd($prodjs['CODIGO']);
            //sacame el id de producto con el code oem
            $p = Producto::where('cod_oem', $prodjs['CODIGO'])->first();
            // dd($p);
            if ($p) {
                dd($p);
                $p->marca = $prodjs['MARCA'];
                $p->cantidad = $prodjs['CANTIDAD'];
                $p->estante = $prodjs['UBICACION'];
                $p->unidad = $prodjs['UNIDAD'];
                $p->save();
                $c++;
            } else {
                // $c++;
                //guardar en una array
                // $ProductosNoGuardados[] = $prodjs;
            }
        }


        return redirect()->route('Rol.index')->with('Mensaje', $c . 'Productos Actualozados Correctamente');

        // $ProductosNO = [
        //     "Productos" => $ProductosNoGuardados,
        // ];
        // $ProductosNoGuardados[]s;
        // dd($ProductosNoGuardados,$c,count($prodjs));
        // dd(gettype($ProductosNoGuardados));
        // $json = json_encode($ProductosNO, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        // $nombreArchivo = public_path('js/productos_no_guardados.json');
        // // Guarda el archivo con el contenido en la carpeta public/directorio-personalizado
        // // Storage::disk('public')->put('js/productos_no_guardados.text', $contenido);
        // // Crea el archivo JSON y escribe el contenido
        // if (file_put_contents($nombreArchivo, $json) !== false) {
        //     echo "El archivo $nombreArchivo se creó correctamente.";
        // } else {
        //     echo "Error al crear el archivo $nombreArchivo.";
        // }

        // return $json;
    }



    public function GetUnidadesProductos(){
        dd('stop');
        $mis_unidades = [];
        foreach (Producto::all() as $p) {
            //in_array = si unidad existe en el array mis unidades
            if (!in_array($p->unidad, $mis_unidades)) {
                //entrar si no existe la unidad
                $mis_unidades[] = $p->unidad;
            }

        }
        dd($mis_unidades);
    }

    public function GetUnidadesProdJson(){
        $jsonString = file_get_contents(public_path('js/backupxd/productos.json'));
        $productosJson = json_decode($jsonString, true);
        $mis_unidades = [];
        foreach ($productosJson['Productos'] as $p) {
            //in_array = si unidad existe en el array mis unidades
            if (!in_array($p['UNIDAD'], $mis_unidades)) {
                //entrar si no existe la unidad
                $mis_unidades[] = $p['UNIDAD'];
            }

        }
        dd($mis_unidades);
    }



    //sacar todos los id proucdto en tu gerente 
    //sacar todo los id_gerente en loocal
    //comparar del local quien no esta en tu gerente
    //luego biceversa

    public function compararCod_Gerente(){
         // $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
         $jsonString = file_get_contents(public_path('restaurarProductos/productos.json'));
         $ProducGerente = json_decode($jsonString, true);

     
         $ProducGerente  =   $ProducGerente ['Productos'];
      
         //poner en un array los id_gerente
            $id_gerente = [];
            foreach ($ProducGerente as $p) {
                $id_gerente[] = $p['id_producto'];
            }
            // dd($id_gerente);

        $listaPro = [];
        $productos = Producto::get();
        //recorrero produc local y buscar en la lista id_gerente
        foreach ($productos as $prod) {
            // dd($prod->id_tugerente);
            if(!in_array($prod->id_tugerente, $id_gerente)){
                // dd('no esta en tu gerente',$prod);
                $listaPro[] = $prod->cod_producto;
            }

        }

        dd($listaPro);


       
    }



    public static function cargarIdproducto(){
        // dd('llegue');
         //estamos trayendo todas las id_producto en tu gerente
         $response = Http::withHeaders([
            'ApiKey' => 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338',
            'Data-Operations' => json_encode([
                'take' => 5000,
                'skip' => 4000,
            ])
        ])->timeout(180)->get('https://back.tugerente.com/v1/warehouses/product/',);

        // dd($response->json()['results']);
         $productos=[];
        $result = $response->json()['results'];
        foreach ($result as $r) {
            $productos[] = [
                'cod_oem' => $r['code'],
                'id_producto' => $r['id']
            ];
        }

        // dd(count($productos),$productos);
        //ponerlo en un json
         $Productos= [
                "Productos" => $productos,
            ];
            // $ProductosNoGuardados[]s;
            // dd($ProductosNoGuardados,$c,count($prodjs));
            // dd(gettype($ProductosNoGuardados));
            $json = json_encode($Productos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $nombreArchivo = public_path('restaurarProductos/productos5.json');
            // Guarda el archivo con el contenido en la carpeta public/directorio-personalizado
            // Storage::disk('public')->put('js/productos_no_guardados.text', $contenido);
            // Crea el archivo JSON y escribe el contenido
            if (file_put_contents($nombreArchivo, $json) !== false) {
                echo "El archivo $nombreArchivo se creó correctamente.";
            } else {
                echo "Error al crear el archivo $nombreArchivo.";
            }

            return redirect()->route('restaurarProductos.index')->with('Mensaje', 'Productos Actualozados Correctamente');
    }





##############    metodo para eliminar las letras xd xd xd    ######################333
    public function EliminarEspacios()
    {
         // $productos = ProductosVendido::get();
        $productos = Producto::get();
        // dd($productos);
        foreach ($productos as $p) {
            //eliminar espacios en blanco
            if ($p->tienda == 'Repuestos') {
                $cadena = trim($p->cod_oem);
                $acu = '';
                for ($i = 0; $i < strlen($cadena); $i++) {
                    if ($cadena[$i] == ' ' || $cadena[$i]  == '-' || $cadena[$i]  == '_' || $cadena[$i]  == '.' || $cadena[$i]  == ',') {
                        // dd('es igual a espacio,',$row);
                    } else {
                        $acu .= $cadena[$i];
                    }
                }
                // if($p->cod_oem != $acu){
                // dd($p->id, $acu, $p->cod_sustituto);

                $p->cod_oem = $acu;
                $p->save();
                // }

                $cadena = trim($p->cod_producto );
                $acu = '';
                for ($i = 0; $i < strlen($cadena); $i++) {

                    if ($cadena[$i] == ' ' || $cadena[$i]  == '-' || $cadena[$i]  == '_' || $cadena[$i]  == '.' || $cadena[$i]  == ',') {
                        // dd('es igual a espacio,',$row);
                    } else {
                        $acu .= $cadena[$i];
                    }
                }
                //  if($p->cod_producto != $acu){
                // dd($p->id, $acu, $p->cod_sustituto);
                $p->cod_producto = $acu;
                $p->save();
                //  }
            }
        }
        // dd('terminado');
    }

    public function eliminarLetras($num){

        $productos = Producto::get();
        $letras_sacar_dos = ['FP', 'PX', 'LK', 'MP', 'CR'];
        $letras_sacar_tres = [
            'CUM', 'CTP', 'MAK', 'ROK', 'KMP', 'CAT', 'PAI', 'SKF', 'NAT', 'NAV',
            'DDC', 'HDK', 'VOL', 'FUL', 'STE', 'TIM', 'CRI', 'DAN', 'HTN', 'ETA', 'SAP', 'MAC', 'WAK', 'MID'
        ];
        $letras_sacar_cuatro = ['ARCA', 'SABO'];
        $letras_sacar_cinco = ['VOLVO', 'MCBEE',];

        $superlista = ['','',
            $letras_sacar_dos,
            $letras_sacar_tres,
            $letras_sacar_cuatro,
            $letras_sacar_cinco
        ];
      
        // dd($num,$superlista[$num]);
        $cadenas = [];
        $acumulador = [];
        $id_producto = [];
        foreach ($productos as $p) {
            $cadena = $p->cod_oem;
            $acu = '';
            for ($i = 0; $i < strlen($cadena); $i++) {
                //sacar_5dig
                $acu = $acu . $cadena[$i];
                if (strlen($acu) == $num) { //misma cantidad de digitos
                    if (in_array($acu, $superlista[$num])) {
                        $cadena = substr($cadena, $num);
                        $p->cod_oem = $cadena;
                        $p->save();
                    }
                    break;
                }
            }
            $cadena = $p->cod_producto ;
            $acu = '';
            for ($i = 0; $i < strlen($cadena); $i++) {
                //sacar_5dig
                $acu = $acu . $cadena[$i];
                if (strlen($acu) == $num) {
                    if (in_array($acu, $superlista[$num])) {
                        $cadena = substr($cadena, $num);
                        $p->cod_producto  = $cadena;
                        $p->save();
                    }
                    break;
                }
            }
        }
        // dd('terminado2');
    }

    public function LimpiezaProductos(){
        //ejecutar limpiar espacio 
        $this->EliminarEspacios();
        //ejecutar eliminar letras y guiones
        $this->eliminarLetras(5);
        $this->eliminarLetras(4);
        $this->eliminarLetras(3);
        $this->eliminarLetras(2);
        dd('terminado putito!!');
    }




###########    verificar todas la cotizaciones esten bien cargadas   ##########################
    public function verificarCotizacion(){
        $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
        $jsonString = json_decode($jsonString, true);

        $lista = [];
        //pasar por la lista de detalles de json 
        foreach ($jsonString['DetallesCotizaciones'] as $key => $d) {
            // verificar si esta dentro de la base de datos cmmotors 
            $detalle = DetalleCotizacion::where('id',$d['id'])->first();
            if(is_null($detalle)){
                //crearlo, 
                if($d["id_cotizacion"] == 328 || $d["id_cotizacion"] == 329){
                    //verificar si existe el prod
                    $p = Producto::where('id',$d['id_producto'])->first();
                    if(!is_null($p)){
                        // $deta = new DetalleCotizacion();'
                        DetalleCotizacion::create($d);
            // 'cantidad'
            // precio'
            // id_producto'
            // 'id_cotizacion'
            // 'precio_producto_unitario'
            // 'tiempo_entrega'
            // 'detalle_co'
            // 'unidad_co'
                    }else{
                        dd('no existe el producto', $d['id_producto']);
                    }
                }

                // //poner en una lista todo los detales de coti que no stan cargados, 
                // $l['id'] = $d['id'];
                // $coti = Cotizacion::where('id',$d['id_cotizacion'])->first();
                // $l['nro_coti'] = $coti->nro_coti;
                // $l['id_producto'] = $d['id_producto'];
                // $producto = Producto::where('id',$d['id_producto'])->first();
                // if(!is_null($producto)){
                //     $l['cod_prod'] = $producto->cod_producto;
                // }else{
                //     $l['cod_prod'] = 'no existe';
                // }
                // $lista[] = $l;
            }
        }
        // dd($lista);
        dd('termainod');
    }

    public function verificarProductos(){
        $jsonString = file_get_contents(public_path('js/backupxd/Json_Cmmotors.json'));
        $jsonString = json_decode($jsonString, true);

        $lista = [];
        $nombres = [];
        //pasar por la lista de detalles de json 
        foreach ($jsonString['Productos'] as $key => $p) {
            // verificar si esta dentro de la base de datos cmmotors 
            $producto = Producto::where('id',$p['id'])->first();
            if(is_null($producto)){
                //poner en una lista todo los detales de coti que no stan cargados, 
                $l['id'] = $p['id'];
                $l['cod_producto'] = $p['cod_producto'];
                $lista[] = $l;
            }else{
                if($p['cod_producto'] != $producto->cod_producto){
                    $nombres[] = $p['cod_producto'];
                }
            } 
        }
        dd($lista, $nombres);
    }




}

