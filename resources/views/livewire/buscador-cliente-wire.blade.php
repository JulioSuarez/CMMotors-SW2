<div>
    <div class="w-full overflow-hidden  shadow-xs  ">
        @can('cliente.index')
            <div class="relative max-w-full flex justify-between pb-2 flex-1 text-right">
                <div class="flex z-50">
                    <a href="{{ Route('Cliente.create') }}"
                        class="bg-blue-500 text-white
                        dark:bg-gray-100  dark:text-gray-800 text-xs font-bold uppercase px-3 flex items-center text-center rounded outline-none focus:outline-none mr-2 ease-linear transition-all duration-150">
                        Nuevo Cliente
                    </a>

                    <div>
                        <input id="ip_buscar"
                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 bg-white border-gray-400 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" wire:model="search" wire:input="cerrarModal"
                            placeholder="Buscar por {{ $buscar_por }}..">
                    </div>


                    <div class="relative h-full">
                        {{-- wire:click='abrirModal()' --}}
                        <div id="bt_buscar"
                            class="ml-1 h-full cursor-pointer flex justify-center items-center text-gray-600 border border-gray-400 bg-white shadow rounded-md px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                        </div>

                        <div id="div_buscar"
                            class="fixed {{ $modal_buscar ? '' : 'hidden' }} w-60 mt-1 rounded-md shadow-md  border border-gray-400 bg-white text-left">
                            <div class="flex flex-col px-2 py-3  text-gray-800 ">
                                <div class="flex  space-x-1 px-1  hover:text-blue-500  ">
                                    <input id="ip_nombre" type="checkbox" name="buscar_select" checked
                                        wire:click='actualizarBuscar("nombre")'>
                                    <label for="ip_nombre" class=" cursor-pointer py-1 ">
                                        Nombre o Razon Social
                                    </label>
                                </div>

                                <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                                    <input id="ip_ci" type="checkbox" name="order_select"
                                        wire:click='actualizarBuscar("ci")'>
                                    <label for="ip_ci" class=" cursor-pointer py-1 ">
                                        CI o NIT
                                    </label>
                                </div>

                                <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                                    <input id="ip_telefono" type="checkbox" name="order_select"
                                        wire:click='actualizarBuscar("telefono")'>
                                    <label for="ip_telefono" class=" cursor-pointer py-1 ">
                                        Telefono
                                    </label>
                                </div>

                                <div class="flex space-x-1 px-1 hover:text-blue-500  ">
                                    <input id="ip_correo" type="checkbox" name="order_select"
                                        wire:click='actualizarBuscar("correo")'>
                                    <label for="ip_correo" class=" cursor-pointer py-1 ">
                                        Correo
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="w-6 h-6 border-t-4 border-blue-500 rounded-full animate-spin"></div> --}}



                    <div id="error_select"
                        class="flex {{ $error_select ? '' : 'hidden' }} justify-center items-center ml-1 p-1 border border-red-600 bg-red-100 text-red-600 text-sm rounded-md  ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-5 h-5 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <p class="ml-1"> Seleccione al menos un campo por buscar</p>
                    </div>
                </div>

                @if (session('success'))
                    <p class="text-white w-fit py-2 px-4 bg-lime-500 text-sm text-center rounded-xl  h-full sm:w-fit">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="relative ">
                    <button id="bt_ordenar"
                        class="flex justify-center items-center px-3 py-1.5  border border-gray-400 bg-white text-gray-700 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-center pr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                        </svg>
                        <span> Ordenar</span>
                    </button>
                    <div id="div_ordenar"
                        class="fixed hidden right-0 mt-1 w-72 h-56 overflow-y-auto bg-white shadow-md  border border-gray-400 rounded-md">
                        <div class="flex flex-col px-2 py-3  text-gray-800 ">
                            <div class="flex  space-x-1 px-1  hover:text-blue-500  ">
                                <input id="ip_cliente_az" type="radio" name="order_select"
                                    wire:click='actualizarOrden("AZ")'>
                                <label for="ip_cliente_az" class=" cursor-pointer py-1 ">
                                    Nombre Cliente A-Z
                                </label>
                            </div>

                            <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                                <input id="ip_cliente_za" type="radio" name="order_select"
                                    wire:click='actualizarOrden("ZA")'>
                                <label for="ip_cliente_za" class=" cursor-pointer py-1 ">
                                    Nombre Cliente Z-A
                                </label>
                            </div>

                            <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                                <input id="ip_cliente_ci_abs" type="radio" name="order_select"
                                    wire:click='actualizarOrden("CIABS")'>
                                <label for="ip_cliente_ci_abs" class=" cursor-pointer py-1 ">
                                    CI Cliente Ascendente
                                </label>
                            </div>

                            <div class="flex   space-x-1 px-1 hover:text-blue-500  ">
                                <input id="ip_cliente_ci_des" type="radio" name="order_select"
                                    wire:click='actualizarOrden("CIDES")'>
                                <label for="ip_cliente_ci_des" class=" cursor-pointer py-1 ">
                                    CI Cliente Descendente
                                </label>
                            </div>

                            <div class="flex   space-x-1 px-1  hover:text-blue-500  ">
                                <input id="ip_cliente_abs" type="radio" name="order_select"
                                    wire:click='actualizarOrden("ABS")'>
                                <label for="ip_cliente_abs" class=" cursor-pointer py-1">
                                    Creado (el mas antiguo primero)
                                </label>
                            </div>

                            <div class="flex   space-x-1 px-1  hover:text-blue-500  ">
                                <input id="ip_cliente_des" type="radio" name="order_select" checked
                                    wire:click='actualizarOrden("DEC")'>
                                <label for="ip_cliente_des" class=" cursor-pointer py-1">
                                    Creado (el mas reciente primero)
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <script>
                    let div_ordenar = document.getElementById('div_ordenar');
                    let bt_ordenar = document.getElementById('bt_ordenar');
                    bt_ordenar.addEventListener('click', function() {
                        div_ordenar.classList.toggle('hidden');
                    });

                    let div_buscar = document.getElementById('div_buscar');
                    let bt_buscar = document.getElementById('bt_buscar');
                    bt_buscar.addEventListener('click', function() {
                        div_buscar.classList.toggle('hidden');
                        window.livewire.emit('abrirModal');
                    });
                </script>
            </div>
        @endcan
        <div id="tabla_cliente" class="w-full overflow-x-auto z-50">
            <table class="w-full ">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left uppercase border-b
                         dark:border-gray-700 text-gray-300 h-12 bg-gray-800">
                        <th class="text-center">Nro</th>
                        <th class="pl-4 ">Nombre ó Razon Social</th>
                        <th class="pl-2 ">CI/NIT</th>
                        <th class="pl-1 ">Telefono</th>
                        <th class="pl-2 ">Dirección</th>
                        <th class="pl-2">Correo</th>
                        <th class="pl-2">Estado</th>
                        <th class="pl-2">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @php
                        $cont = 0;
                    @endphp

                    @forelse ($clientes as $p)
                        <tr
                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 text-gray-700
                             dark:hover:bg-gray-900  dark:text-gray-400">
                            <td class="px-4 py-4 text-sm">
                                {{ ++$cont }}
                            </td>
                            <td class=" h-full">
                                {{-- href="{{ route('Cliente.show', $p->ci) }}" --}}
                                <div class="flex items-center text-sm hover:bg-white">
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                            alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $p->nombre }} </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $p->empresa }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 text-sm ">{{ $p->ci }}</td>
                            <td class="px-2  text-sm">
                                <p>{{ $p->telefono }}</p>
                            </td>
                            <td class="text-xs px-1 text-gray-600 ">
                                <p>{{ $p->direccion }}</p>
                            </td>
                            <td class="px-1 text-xs ">
                                <p>{{ $p->correo }}</p>
                            </td>
                            <td class=" text-xs ">

                                @if ($p->ci == 2809343)
                                    <p class="px-2 py-1 bg-red-100 border border-red-500 rounded-lg text-red-700">
                                        Cliente generico</p>
                                @else
                                    <p class="px-2 py-1 bg-blue-100 border border-blue-500 rounded-lg text-blue-700">
                                        Homologado</p>
                                @endif
                            </td>
                            <td class="px-1  text-xs">
                                @can('cliente.edit')
                                    <button type="button"
                                        class="m-2 px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        <a href="{{ Route('Cliente.edit', $p->ci) }}">
                                            EDITAR
                                        </a></button>
                                @endcan
                                {{-- @can('cliente.destroy')
                                    <button type="button"
                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                        <form action="{{ Route('Cliente.destroy', $p->ci) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="ELIMINAR" class=""
                                                onclick="return confirm('Desea Eliminar?')">
                                        </form>
                                    </button>
                                @endcan --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="text-xl text-gray-600 dark:text-gray-400">
                                    "No se encontraron coincidencias"
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <script>
            let tabla_cliente = document.getElementById('tabla_cliente');
            // Agrega un escuchador de eventos al elemento
            document.getElementById('ip_buscar').addEventListener('keydown', function(event) {
                // El código dentro de esta función se ejecutará cada vez que alguien presione una tecla
                console.log('Tecla presionada:', event.key);
                tabla_cliente.classList.add('opacity-75');
                console.log(tabla_cliente);
                // Puedes realizar acciones adicionales aquí, como enviar una solicitud AJAX o realizar una búsqueda
            });
        </script>
        {{-- <div
            class="grid px-4 py-3  text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <!-- Pagination -->
        </div> --}}
    </div>
</div>
