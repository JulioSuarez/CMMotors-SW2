@extends('navegador')

@section('Contenido')

<link rel="stylesheet" href="{{ asset('css/desabilitarInputNumber.css') }}" />

<h1 class="text-center text-lg m-4 font-semibold font-serif ">
    REGISTRO DE PROVEEDORES
</h1>


    <form action="#" method="post">
        @csrf
        @method('POST')
        <div class=" flex items-center justify-center"> <!--container max-w-lg-->

            <div class="py-4 px-6 max-w-full m-4 bg-white rounded-xl "> <!--container max-w-lg -->


                <label for="ci_autocomplete" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    NIT/CI/CEX/P:
                </label>

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
                    <input
                        class="text-gray-500 focus:outline-none focus:border focus:border-blue-900  font-normal w-full h-8 flex items-center pl-16  text-sm border-gray-300 rounded border"
                        id="ci_autocomplete" name="ci_cliente" type="number" autofocus="true"  autocomplete="off"/>
                </div>


                <label for="empresa" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Empresa:
                </label>
                <input id="empresa"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="cliente" type="text" autocomplete="off" />

                <label for="persona_contacto" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Persona de Contacto:
                </label>
                <input id="persona_contacto"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="cliente" type="text" autocomplete="off" />


                <label for="telefono"
                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Telefono:</label>
                <input id="telefono"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="telefono" type="number" autocomplete="off" />

                    <label for="telefono"
                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Correo:</label>
                <input id="telefono"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="telefono" type="number" autocomplete="off" />

                <label for="telefono" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Direccion:
                </label>
                <input id="telefono"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="telefono" type="number" autocomplete="off" />



                <label for="nit" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Tipo:
                </label>
                <input id="nit"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border " autocomplete="off"
                    name="nit" type="number" />


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
                                <span class="">Cancelar</span>
                            </button>
                        </div>
                    </div>

            </div>



        </div>




    </form>



@endsection

