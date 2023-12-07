<dialog id="myModal_productos"
class=" rounded-xl  max-w-full lg:w-1/4 ">
    <button id="bt_cerrar_M_productos"  type="button"
    class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600 ">
        <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
        </svg>
    </button>

        <div class=" flex items-center justify-center "> <!--container max-w-lg-->
            <div class="py-2 "> <!--container max-w-lg -->

                <h1 class="text-center text-sd  font-semibold font-sans ">
                    CREAR PROVEEDOR
                </h1>


                <div class="flex justify-between">
                    <label class="text-gray-800 text-sm pt-1.5 font-bold leading-tight tracking-normal">
                        NIT/CI/CEX/P:
                    </label>
                    <p id="p_proveedor_existe" >
                    </p>

                    {{-- <p id="p_proveedor" class="text-white text-xs bg-red-500 p-1  rounded-xl  w-max">
                        El registro ya existe
                     </p> --}}
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
                    <input
                        class="text-gray-500 focus:outline-none focus:border focus:border-blue-900  font-normal w-full h-8 flex items-center pl-16  text-sm border-gray-300 rounded border"
                        id="nit_buscar" name="nit_provee" type="number" autofocus="true"  autocomplete="off"/>
                </div>


                <label for="empresa_provee" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Empresa:
                </label>
                <input id="empresa_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="empresa_provee" type="text" autocomplete="off" />

                <label for="persona_contacto_provee" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Nombre de Contacto:
                </label>
                <input id="persona_contacto_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="contacto_provee" type="text" autocomplete="off" />


                <label for="telefono_provee"
                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Telefono:</label>
                <input id="telefono_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="telefono_provee" type="number" autocomplete="off" />

                    <label for="correo_provee"
                    class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Correo:</label>
                <input id="correo_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="correo_provee" type="text" autocomplete="off" />

                <label for="direccion_provee" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Direccion:
                </label>
                <input id="direccion_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border"
                    name="direccion_provee" type="text" autocomplete="off" />



                <label for="tipo_provee" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">
                    Tipo:
                </label>
                <input id="tipo_provee"
                    class="mt-0 mb-1 text-gray-600 focus:outline-none focus:border focus:border-blue-900 font-normal w-full h-8 flex items-center pl-3 text-sm border-gray-300 rounded border " autocomplete="off"
                    name="tipo_provee" type="text" />


                    <div class="flex flex-row-reverse pt-4   rounded-b-lg">
                        <div class="flex-initial ">
                            <button type="button" id="bt_guardar_proveedoreM"
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
                            <button type="submit" id="bt_cancelarM_proveedor"
                                class="flex items-center px-2 py-2 font-medium tracking-wide text-red-700 capitalize border-4 border-red-600 rounded-md hover:bg-red-500 hover:fill-current hover:text-white  focus:outline-none  transition duration-300 transform active:scale-95 ease-in-out text-base h-10">
                                <span class="">Cancelar</span>
                            </button>
                        </div>
                    </div>

            </div>



        </div>


    {{-- </form> --}}
    <script src="{{ asset('js/Proveedor/ProveedorExiste.js') }}"></script>

</dialog>
