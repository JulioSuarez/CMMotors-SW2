<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class AutorellenoCliente extends Component
{
    public $buscar_cliente = '';
    public $modal_busqueda = false;


    protected $listeners = [
        'event_modal_busqueda' => 'modal_busqueda',
        'event_abrir_modal' => 'abri_modal',
        'event_cerrar_modal' => 'cerrar_modal',
    ];

    public function mount($cliente = null)
    {
        if($cliente)
            $this->buscar_cliente = $cliente;   
    }
    

    public function clickAutorelleno(Cliente $cliente){
        // dd('le di click en' ,$ci);
        //llamar a un metodo de java scrip 
        $this->emit('autorellenarCliente',[
            'nombre' => $cliente->nombre,
            'ci' => $cliente->ci,
            'telefono' => $cliente->telefono,
        ]);
        $this->modal_busqueda = false;
        // $this->buscar_cliente = $cliente->nombre;
    }

    public function modal_busqueda(){
        $this->modal_busqueda = !$this->modal_busqueda;
    }

    public function abri_modal(){
        $this->modal_busqueda = true;
    }

    public function cerrar_modal(){
        $this->modal_busqueda = false;
    }

    public function render()
    {
        //mostar los clientes mas frecuentes 
        $clientes = Cliente::where('nombre', 'like', '%' .$this->buscar_cliente . '%')->get();

        //mostar mensaje en cosole log


        return view('livewire.autorelleno-cliente',compact('clientes'));
    }
}
