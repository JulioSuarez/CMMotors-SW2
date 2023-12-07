<div>
    <div id="div_cliente"
     class="relative flex justify-between h-full border border-gray-300 rounded mb-1 div-parent  ">
        
            <input id="cliente" wire:model='buscar_cliente' type="text"
            class="  px-3  text-gray-600 outline-none flex-1 font-normal   h-8 flex items-center text-sm rounded  capitalize"
            name="cliente" type="text" autocomplete="off" value="{{ old('cliente') }}" />
        {{-- @dd($nombre_cliente) --}}
       <div class="w-16 ">
            <button id="bt_abrir_busqueda_clientes" type="button"
                class="absolute right-0 h-full w-10 flex justify-center items-center bg-gray-300 rounded-r-sm ">
                <svg id="bt_svg" class=" h-[94%] w-[97%]  " 
                    xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path id="bt_path" fill="currentColor"
                        d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z" />
                </svg>
            </button>
        
            <div class="flex items-center justify-center absolute right-10 h-full  mr-1" 
                id="div_spinner">
                
                
                
            </div>
       </div>
    </div>

    <div id="div_busqueda_cliente" 
        class="scrollbar-xd busqueda w-full bg-white {{ $modal_busqueda ? '':'hidden' }} flex flex-col absolute h-48 overflow-y-auto  border border-gray-300 rounded-sm">
       @foreach ($clientes as $cliente)
            <button type="button" wire:click='clickAutorelleno("{{ $cliente->ci }}")'
            class="busqueda px-3 py-1 bg-white text-left hover:bg-gray-200 ">
               {{  $cliente->nombre }}
            </button>
       @endforeach
     
        

    </div>
</div>


