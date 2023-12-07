@extends('navegador')

@section('Contenido')
    <div class="p-6 mr-2 bg-gray-100 dark:bg-gray-800 ">
        <div class="md:grid md:grid-cols-2  md:gap-6">
            <div class="mt-5 md:col-span-2 md:mt-0">
                <form action="{{ Route('Producto.update', $p->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div
                            class="px-4 bg-gray-100 dark:bg-gray-700 text-white dark:text-white align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                            <!-- <div class="space-y-6 bg-white px-4 py-5 sm:p-6"> -->

                            <div class="col-span-6 sm:col-span-3">
                                <label for="nombre"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Nombre del Producto</label>
                                <input type="text" name="nombre" value="{{ $p->nombre }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="cod_oem"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Codigo OEM</label>
                                <input type="text" name="cod_oem" value="{{ $p->cod_oem }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="cod_sustituto"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Codigo Alternativo</label>
                                <input type="text" name="cod_sustituto" value="{{ $p->cod_sustituto }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="cantidad"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Cantidad en Stock</label>
                                <input type="text" name="cantidad" value="{{ $p->cantidad }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="cant_minima"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Cantidad Minima</label>
                                <input type="text" name="cant_minima" value="{{ $p->cant_minima }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label for="marca"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Marca
                                </label>
                                <input type="text" name="marca" value="{{ $p->marca }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="procedencia"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Procedencia
                                </label>
                                <input type="text" name="procedencia" value="{{ $p->procedencia }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="origen"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Origen del Producto
                                </label>
                                <input type="text" name="origen" value="{{ $p->origen }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="proveedor"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Seleccionar Proveedor</label>
                                <select name="proveedor"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">

                                    @foreach ($proveedor as $pro)
                                        @if ($pro->id == $p->id_proveedor)
                                            <option value="{{ $pro->id }}">{{ $pro->nombre_proveedor }}</option>
                                        @endif
                                    @endforeach

                                    @foreach ($proveedor as $pro)
                                        @if ($pro->id != $p->id_proveedor)
                                            <option value="{{ $pro->id }}">{{ $pro->nombre_proveedor }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="unidad"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Tipo de Unidad
                                </label>
                                <input type="text" name="unidad" value="HABILITADO"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="precio1"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Precio de Venta Con Factura
                                </label>
                                <input type="number" name="precio1" value="{{ $p->precio_venta_con_factura }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="precio2"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Precio de Venta Sin Factura
                                </label>
                                <input type="number" name="precio2" value="{{ $p->precio_venta_sin_factura }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="precio3"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Precio de Compra
                                </label>
                                <input type="number" name="precio3" value="{{ $p->precio_compra }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="fecha_expiracion"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Fecha expiración
                                </label>
                                <input type="date" name="fecha_expiracion" value="{{ $p->fecha_expiracion }}"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="tienda"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">Tienda</label>
                                <select name="tienda"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                                    <option>Repuestos</option>
                                    <option>Ferreteria</option>
                                    <option>Deposito Ferreteria</option>
                                    <option>Deposito Taller</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label for="estante"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Ubicación
                                </label>
                                <input type="text" name="estante" value="{{ $p->estante }}"
                                    oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);"
                                    class="text-center w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="estado"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">Estado
                                    del
                                    Producto</label>
                                <select name="estado"
                                    class="w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                                    <option>HABILITADO</option>
                                    <option>DESHABILITADO</option>
                                </select>
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                                <label for="foto"
                                    class="block text-normal text-lg sm:text-2xl font-medium text-gray-600 dark:text-gray-400">
                                    Foto</label>
                                <!-- class="absolute inset-0 rounded-full shadow-inner" -->
                                <div
                                    class="flex items-center justify-center w-full mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none">
                                     <img src="{{ asset('img/fotosProductos/' . $p->foto) }}"
                                        alt="Model wearing plain white basic tee." width="250"
                                        class=" h-full object-cover object-center">
                                </div>

                                <input  name="foto" type="file">
                            </div>
                        </div>

                        <div
                            class="px-4 bg-gray-100 dark:bg-gray-700 text-white dark:text-white align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="pantalla" value="producto">
@endsection
