@extends('navegador')
@section('Contenido')
    <div class=" flex items-center justify-center ">
        <div class="bg-white">
            <div class="pt-6">
                <nav aria-label="Breadcrumb">
                    <ol role="list"
                        class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                        <li>
                            <div class="flex items-center">
                                <a href="/" class="mr-2 text-sm font-medium text-gray-900">Inicio</a>
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                </svg>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center">
                                <a href="/Producto" class="mr-2 text-sm font-medium text-gray-900">Productos</a>
                                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                    <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                </svg>
                            </div>
                        </li>

                        <li class="text-sm">
                            <p aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ $p->nombre }}
                            </p>
                        </li>
                    </ol>
                </nav>

                <!-- Image gallery -->
                <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
                    <!-- <div class="aspect-w-3 aspect-h-4 hidden rounded-lg lg:block">
                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg" alt="Two each of gray, white, and black shirts laying flat." class="h-full w-full object-cover object-center">
                  </div>
                  <div class=" lg:grid lg:grid-cols-1 lg:gap-y-8">
                    <div class="aspect-w-3 aspect-h-2 rounded-lg">
                      <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg" alt="Model wearing plain black basic tee." class="h-full w-full object-cover object-center">
                    </div>
                    <div class="aspect-w-3 aspect-h-2 rounded-lg">
                      <img src="https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg" alt="Model wearing plain gray basic tee." class="h-full w-full object-cover object-center">
                    </div>
                  </div> -->
                    <div class="aspect-w-4 aspect-h-5 sm sm:rounded-lg lg:aspect-w-3 lg:aspect-h-4">
                        <img src="{{ asset('img/fotosProductos/' . $p->foto) }}" alt="Model wearing plain white basic tee."
                            width="350" class=" h-full object-cover object-center">
                    </div>
                </div>

                <!-- Product info -->
                <div
                    class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
                    <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                        <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $p->nombre }}</h1>
                    </div>

                    <!-- Options -->
                    <div class="mt-4 lg:row-span-3 lg:mt-0">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-2xl tracking-tight text-gray-900">Bs.- {{ $p->precio_venta_con_factura }} | Estante
                            {{ $p->estante }} | Stock: {{ $p->cantidad }}</p>
                        <!-- <p class="text-2xl tracking-tight text-gray-900">Ubicación {{ $p->estante }}</p> -->
                    </div>

                    <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pr-8">
                        <!-- Description and details -->
                        <div class="mt-10">
                            <h3 class="text-sm font-medium text-gray-900">Descripción</h3>

                            <div class="mt-4">
                                <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                    <li class="text-gray-400"><span class="text-gray-600">Codigo: {{ $p->cod_oem }}</span>
                                    </li>
                                    <li class="text-gray-400"><span class="text-gray-600">Alternativo:
                                            {{ $p->cod_sustituto }}</span></li>

                                    <li class="text-gray-400"><span class="text-gray-600">Marca: {{ $p->marca }}</span>
                                    </li>
                                    <li class="text-gray-400"><span class="text-gray-600">Procedencia:
                                            {{ $p->procedencia }}</span></li>
                                    <li class="text-gray-400"><span class="text-gray-600">Origen:
                                            {{ $p->origen }}</span></li>

                                    <li class="text-gray-400"><span class="text-gray-600">Stock: {{ $p->cantidad }}</span>
                                    </li>
                                    <li class="text-gray-400"><span class="text-gray-600">Vence:
                                            {{ $p->fecha_expiracion }}</span></li>
                                    @foreach ($proveedor as $fila)
                                        @if ($fila->id == $p->id_proveedor)
                                            <li class="text-gray-400"><span class="text-gray-600">Proveedor:
                                                    {{ $fila->nombre_proveedor }} |
                                                    {{ $fila->proveedor_direccion }}</span></li>
                                            <li class="text-gray-400"><span class="text-gray-600">Contacto:
                                                    {{ $fila->nombre_proveedor_contacto }} |
                                                    {{ $fila->proveedor_telefono }}</span></li>
                                            <li class="text-gray-400"><span class="text-gray-600"></span></li>
                                            <li class="text-gray-100"><span class="text-gray-100">.</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="mt-10">
                      <h2 class="text-sm font-medium text-gray-900">Details</h2>

                      <div class="mt-4 space-y-6">
                        <p class="text-sm text-gray-600">The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming &quot;Charcoal Gray&quot; limited release.</p>
                      </div>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
