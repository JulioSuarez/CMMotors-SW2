<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class BuscadorClienteWire extends Component
{
    public $search = '';
    public $buscar_por = 'nombre';
    public $error_select = false;
    public $modal_buscar = false;
    public $clieAZ = false;
    public $clieZA = false;
    public $clieAbs = false;
    public $clieDes = false;
    public $clieCiAsc = false;
    public $clieCiDes = false;
    public $clieBuscar = [
        'nombre' => true,
        'ci' => false,
        'telefono' => false,
        'correo' => false,
    ];

    protected $listeners = [
        'abrirModal' => 'abrirModal',
    ];


    public function abrirModal(){
        $this->modal_buscar = !$this->modal_buscar;
    }

    public function cerrarModal(){
        $this->modal_buscar = false;
    }


    public function actualizarOrden($value)
    {
        $value == 'AZ' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [true, false, false, false,false,false] : null;
        $value == 'ZA' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [false, true, false, false,false,false] : null;
        $value == 'ABS' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [false, false, true, false,false,false] : null;
        $value == 'DEC' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [false, false, false, true,false,false] : null;
        $value == 'CIABS' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [false, false, false, false,true,false] : null;
        $value == 'CIDES' ? [$this->clieAZ, $this->clieZA, $this->clieAbs, $this->clieDes,$this->clieCiAsc,$this->clieCiDes,] = [false, false, false, false,false,true] : null;

    }


    public function actualizarBuscar($value)
    {
        $value == 'nombre' ? $this->clieBuscar['nombre'] = !$this->clieBuscar['nombre'] : null;
        $value == 'ci' ? $this->clieBuscar['ci'] = !$this->clieBuscar['ci'] : null;
        $value == 'telefono' ? $this->clieBuscar['telefono'] = !$this->clieBuscar['telefono'] : null;
        $value == 'correo' ? $this->clieBuscar['correo'] = !$this->clieBuscar['correo'] : null;
        // $this->buscar_por = $value;
        $this->__buscarSacar($value);

        //si todos son false; mostrar un mensaje de error
        if(!$this->clieBuscar['nombre'] && !$this->clieBuscar['ci'] 
        && !$this->clieBuscar['telefono']&& !$this->clieBuscar['correo']){
            $this->error_select = true;
        }else{
            $this->error_select = false;
        }
    }

    private function __buscarSacar($valor){
        //buscar si esa palabra esta en buscarpor
        // dd($valor);
        $acu = '';
        $cadena = $this->buscar_por.','	;
        $this->buscar_por = '';
        $ban = false;
        for ($i=0; $i < strlen( $cadena) ; $i++) { 
            //sacar palabra 
            if($cadena[$i] == ','){
                if($acu != $valor){
                    // dd($acu, $valor, $i);
                    $this->buscar_por = $this->buscar_por . $acu . ',';
                    $acu = '';
                }else{
                    //lo encontre y no lo acumule
                    $ban = true;
                }
            }else{
                $acu = $acu . $cadena[$i];
            }
                
        }
        if(!$ban){
            $this->buscar_por = $this->buscar_por . $valor;
        }else{
            $this->buscar_por = substr($this->buscar_por, 0, -1);
        }
        // dd($this->buscar_por);
    }

    private function __realizarBusqueda(){
       
        $clientes = Cliente::when($this->clieBuscar['nombre'], function ($q) {
            $q->orWhere('nombre', 'like', $this->search . '%');
            return $q;
        })
        ->when($this->clieBuscar['ci'], function ($q) {
            $q->orWhere('ci', 'like', $this->search . '%')
            ->orWhere('nit', 'like', $this->search . '%');
            return $q;
        })
        ->when($this->clieBuscar['telefono'], function ($q) {
            $q->orWhere('telefono', 'like', $this->search . '%');
            return $q;
        })
        ->when($this->clieBuscar['correo'], function ($q) {
            $q->orWhere('correo', 'like', $this->search . '%');
            return $q;
        });

        return $clientes;
    }


    


    public function render()
    {
        $clientes = $this->__realizarBusqueda();
        //hacer una funcion que te devuelva la lista de clientes 
        // $clientes = Cliente::where('nombre','like', $this->search . '%');
                
        if($this->clieAZ){
            $clientes = $clientes->orderBy('nombre', 'asc');
        }else
            if($this->clieZA){
                $clientes = $clientes->orderBy('nombre', 'desc');
            }else
                if($this->clieCiAsc){
                    $clientes = $clientes->orderBy('ci', 'asc');
                }else
                    if($this->clieCiDes){
                        $clientes = $clientes->orderBy('ci', 'desc');
                    }
        
        
        if($this->clieAbs){
            $clientes = $clientes->get()->reverse();
        }else 
            $clientes = $clientes->get();          

                
        return view('livewire.buscador-cliente-wire', compact('clientes'));
    }
}
