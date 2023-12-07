<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;

use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Dompdf\Option;
use Dompdf\Exception as DomException;
use Dompdf\Options;
use PDF;


class ClienteController extends Controller
{
    private $__apiKey = 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338';
    private $__urlApi = '';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //metodo latest() permite mostar los ultimos registros
        // $clientes = Cliente::get(); compact('clientes')
        return view('VistaClientes.index', );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('VistaClientes.create');
    }

    public function ActualizarCliente()
    {
        $__api_key = 'OeTMTOa9iTTBLrMwTMXsVgdn31PatNHIyzpmw338';
            $clientes = Cliente::get();
            foreach ($clientes as $c) {
                // dd($c);
                if($c->id_cliente == 0){
                    dd('es igual a cero');
                }  
                $id_cliente = $c->id_cliente;
                    $response = Http::withHeaders([
                        'ApiKey' => $__api_key,
                    ])->put('https://back.tugerente.com/v1/sales/customer/'.$id_cliente, [
                        "name" => 'BOLINTER LTDA XD XD',
                        // "nit" => $nit,
                        // "payment_method" => 2,
                        // "reference_name" => $nombre,
                        // "contact_phone" => "70297978",
                        // "contact_phone_prefix" => "591",
                        // "country" => "BO",
                        "document_type" => 5,
                    ]);
        
                 dd($response);
            }

           
            // $id_cliente = 2809343; //este es un cliente generico
            // if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            //     $id_cliente = $response->json()['id'];
            // }
            // // dd($id_cliente);
            // return $id_cliente;
    

        return redirect()->route('Cliente.index')->with('success', 'Clientes actualizados correctamente');
    }


    //usar static cuando no ocupe ningun llamado de storeGErente
    public function store(Request $r)
    {
     
        $r->validate([
            'ci' => 'required',
            'nombre' => 'required',
        ]);
        // dd('pasee',$r);
        $c =  Cliente::where('ci', $r->ci)->first();
        if (is_null($c)) {
            // dd('este cliente no existe'.$r->nombre);
            $c = new Cliente();
            //este no verifica si esta registrado en tugerente
            // $id_cliente = $this->__storeGerente($r->nombre, $r->ci);
            // $c->id_gerete = 0;
            // $c->id_gerete = $id_cliente;
        }

        // $c->id_gerete = 0000;
        $c->ci = $r->ci;
        $c->nombre = strtoupper($r->nombre);
        $c->empresa =  strtoupper($r->empresa);
        // $c->empresa =  $r->nit;
        $c->correo = strtolower($r->correo);
        $c->telefono =  $r->telefono;
        $c->direccion = strtoupper($r->direccion);
        $c->save();
        // dd($c);
        return redirect()->route('Cliente.index')->with('success', 'Cliente registrado correctamente');
    }

    private function __storeGerente($nombre, $nit)
    {
        // dd($nombre,$nit);
        $response = Http::withHeaders([
            'ApiKey' => $this->__apiKey,
        ])->post('https://back.tugerente.com/v1/sales/customer/', [
            // "tenant_id" => 35344,
            "name" => $nombre,
            "nit" => $nit,
            "payment_method" => 2,
            "reference_name" => $nombre,
            "contact_phone" => "70297978", //70297978
            "contact_phone_prefix" => "591",
            "country" => "BO",
            "document_type" => 5,
        ]);

        //  dd($response->json());
        $id_cliente = 2809343; //este es un cliente generico
        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            $id_cliente = $response->json()['id'];
        }
        // dd($id_cliente);
        return $id_cliente;
    }

    public function edit($id)
    {
        $cliente = Cliente::where('ci', $id)->first();
        return view('VistaClientes.edit', compact('cliente'));
    }

    public function update(Request $r, Cliente $cliente)
    {
        $cliente->ci = $r->ci;
        $cliente->nombre = strtoupper($r->nombre);
        $cliente->empresa =  strtoupper($r->empresa);
        $cliente->correo = strtolower($r->correo);
        $cliente->telefono =  $r->telefono;
        $cliente->direccion = strtoupper($r->direccion);
        $cliente->save();
        return redirect()->route('Cliente.index');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('Cliente.index');
    }

    //se usa para
    // public function variables()
    // {
    //     $clientes = Cliente::get();
    //     //dd($clientes);
    //     return view('VistaClientes.lista', compact('clientes'));
    // }

    public function existeCliente(Request $r)
    {
        $p = Cliente::where('ci', $r->valor)->first();
        if ($p != null) {
            $b = true;
        } else {
            $b = false;
        }
        return response()->Json([
            "result" => $b,
            "clientes" => $p,
        ]);
    }



    #---------------------------------------------------------#
    //pruebas para el uso de api
    public function indexApi()
    {
        $clientes = Cliente::get();
        //dd($clientes);
        //  return view('VistaClientes.index', compact('clientes'));
        return $clientes;
    }

    public function showApi(Cliente $ci)
    {
        //  $clientes = Cliente::first();
        //dd($clientes);
        //  return view('VistaClientes.index', compact('clientes'));
        return $ci;
    }

    public function show(Cliente $cliente)
    {
        dd('estamos en cliente controller ');
        //  return view('VistaClientes.show', compact('clientes'));
        // return $ci;
    }



    public function cliente_pdf(Cliente $c)
    {
        $fecha = date('d-m-Y');
        $clientes = Cliente::get();
        $pdf = PDF::loadView('VistaClientes.lista', ['clientes' => $clientes])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Listado de Clientes-' . $fecha . '.pdf', ['Attachment' => 'true']);
    }


    //busqueda de clientes 
    public function buscarCliente(Request $r)
    {
        $clientes = Cliente::where('nombre', 'like', $r->nombre . '%')
            ->orWhere('empresa', 'like', $r->nombre . '%')
            ->limit(7)
            ->get();

        return response()->Json([
            "result" => true,
            "clientes" => $clientes,
        ]);
    }
}
