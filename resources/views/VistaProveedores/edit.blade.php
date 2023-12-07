@extends('navegador')

@section('Contenido')

<link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

<h1 class="text-center text-lg m-8 font-semibold font-Carter ">
    EDITAR UN PROVEEDORE
</h1>

    <form action="{{ Route('Proveedor.update',$p->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class=" flex  justify-center">
            <!--container max-w-lg-->

            <div class="py-4 px-6 w-2/3 mx-4 mt-8 bg-white rounded-xl grid grid-cols-1 lg:grid-cols-2 gap-y-5  gap-x-10">
                <!--container max-w-lg -->

                <!-- ci -->
                <div>
                    <div class="flex justify-between ">
                        <label for="ci_autocomplete" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            *NIT/CI/CEX/P:
                        </label>
                        <p id="p_proveedor_existe">
                        </p>

                        @error('nit')
                            <p class="text-white text-xs bg-red-500 p-1  rounded-xl  w-max">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="relative mt-0 mb-1">
                        <div class="absolute text-gray-600 flex items-center px-4 border-r h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <rect x="3" y="5" width="18" height="14" rx="3" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                                <line x1="7" y1="15" x2="7.01" y2="15" />
                                <line x1="11" y1="15" x2="13" y2="15" />
                            </svg>
                        </div>
                        <input required
                            class="text-gray-500 focus:outline-none focus:border focus:border-blue-900  font-normal
                        w-full h-8 flex items-center pl-16  text-sm border-gray-300 rounded border"
                            id="nit_buscar" name="nit" type="number" value="{{$p->nit }}" autofocus="true"
                            autocomplete="off" />
                    </div>
                </div>

                <!-- nombre -->
                <div>
                    <div class="flex justify-between">
                        <label for="nombre_proveedor" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                            *Proveedor:
                        </label>
                        @error('empresa')
                            <p class="text-white text-xs bg-red-500 p-1  rounded-xl  w-max">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <input id="nombre_proveedor" required
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal
                    w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                        name="nombre_proveedor" type="text" value="{{$p->nombre_proveedor }}" autocomplete="off" />

                </div>

                <!-- nombre de contacto -->
                <div>
                    <label for="nombre_proveedor_contacto" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Nombre de Contacto:
                    </label>
                    <input id="nombre_proveedor_contacto" 
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                        name="nombre_proveedor_contacto" type="text" value="{{$p->nombre_proveedor_contacto }}" autocomplete="off" />

                </div>


                <!-- telefono -->
                <div>
                    <label for="proveedor_telefono" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Telefono:
                    </label>
                    <input id="proveedor_telefono"
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                        name="proveedor_telefono" type="number" value="{{$p->proveedor_telefono }}" autocomplete="off" />
                </div>

                <!-- correo -->
                <div>
                    <label for="proveedor_correo" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Correo:
                    </label>
                    <input id="proveedor_correo"
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                        name="proveedor_correo" type="text" value="{{$p->proveedor_correo }}" autocomplete="off" />
                </div>

                <!-- direccion -->
                <div>
                    <label for="direccion" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Direccion:
                    </label>
                    <input id="direccion" 
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                        name="direccion" type="text" value="{{$p->proveedor_direccion }}" autocomplete="off" />
                </div>


                <!-- tipo -->
                <div>
                    <label for="tipo" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                        Tipo:
                    </label>
                    <input id="tipo" 
                        class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border "
                        autocomplete="off" name="tipo" value="{{$p->tipo }}" type="text" />
                </div>


                <!-- acciones -->
                <div class="flex flex-row-reverse pt-4   rounded-b-lg">
                    <div class="flex-initial ">
                        <button type="submit"
                            class="flex items-center px-2 py-2 font-medium tracking-wide text-white capitalize  bg-gray-700 rounded-md hover:bg-gray-500   focus:outline-none focus:bg-gray-900  transition duration-300 transform active:scale-95 ease-in-out text-sm  ml-4 ">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                                fill="#FFFFFF">
                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                <path
                                    d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z"
                                    opacity=".3"></path>
                                <path
                                    d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z">
                                </path>
                            </svg>
                            <span class="pl-2 mx-1">Guardar</span>
                        </button>
                    </div>
                    <div class="flex-initial">
                        <button type="button"
                            class="flex items-center px-2 py-2 font-medium tracking-wide text-red-700 capitalize border-4 border-red-600 rounded-md hover:bg-red-500 hover:fill-current hover:text-white  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out text-base h-10">
                            {{-- <span class="">Cancelar</span> --}}
                            <a href="{{ route('Proveedor.index') }}">Cancelar</a>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <p class=" flex justify-center text-gray-600 pt-0.5 text-sm">
            *Nota: Los campos que inicien con un ( * ) son obligatorios
        </p>

    </form>


    <input type="hidden" id="pantalla" value="proveedor">
    {{-- <script src="{{ asset('js/Proveedor/ProveedorExiste.js') }}"></script> --}}


@endsection
