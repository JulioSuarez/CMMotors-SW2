@extends('navegador')

@section('Contenido')
    <div class="flex h-full">
        <div class=" w-1/2 flex flex-col items-center justify-center space-y-4 px-4 sm:px-6  lg:px-8">
            <div class=" w-96 h-48 p-5 mt-1 
            bg-white border border-black rounded-md ">
                <p class="text-center"> Importar archivo Excel Julico!!</p>

                <div class="flex flex-col items-center mt-10">
                    <form action="{{ route('deshabilitarProducto') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class=" mb-5" name="documento">

                        <button type="submit" class="btn-green items-end ">
                            Subir Excel deshabilitarProducto
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-5">
                eliminar productos
               <form action="{{ route('deleteTuGerente') }}" method="post">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn-green">
                        Eliminar productos
                    </button> 
               </form>
            </div>
        </div>

        {{-- <div class="max-w-md w-full space-y-8"> --}}
        {{-- <div class="flex items-center justify-center">
                    <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                        alt="Workflow">
                </div> --}}
        {{-- <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <form action="{{ route('importar-productos-masivos') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="archivo">
                            Seleccione el archivo CSV:
                        </label>
                        <input type="file" name="archivo" accept=".xlsx, .xls, .csv" class="block w-full py-2 px-3 border rounded focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cargar Datos 
                        </button>
                    </div>
                </form>
            </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        <div class=" w-1/2 flex justify-center items-center ">


            <div class="space-y-4  flex flex-col items-center font-semibold">

                @if (session('success'))
                    <p class="btn-green w-full"> {{ session('success') }}</p>
                @endif
                <div class="">
                    <div class=" w-96 h-48 p-5 mt-1 
                        bg-white border border-black rounded-md">
                        <p class="text-center"> Exportar archivo Excel</p>
                        <div class="mt-14 flex justify-around space-x-5">
                            <a href="{{ route('exportar.producto.collection') }}" class="btn-green">
                                Exporta (Collection)
                            </a>
                            <a href="{{ route('exportar.producto.view') }}" class="btn-green">
                                Exporta (view)
                            </a>
                        </div>
                    </div>

                </div>

                <div class=" ">
                    <div class=" w-96 h-48 p-5 mt-1 
                bg-white border border-black rounded-md ">
                        <p class="text-center"> Importar archivo Excel</p>

                        <div class="flex flex-col items-center mt-10">
                            <form action="{{ route('import.producto') }}" method="post" enctype="multipart/form-data">
                            {{-- <form action="{{ route('importarVerificar') }}" method="post" enctype="multipart/form-data"> --}}
                            {{-- <form action="{{ route('actualizarProductoImport') }}" method="post" enctype="multipart/form-data"> --}}
                                @csrf
                                <input type="file" class=" mb-5" name="documento">

                                <button type="submit" class="btn-green items-end ">
                                    Subir Excel Cris
                                </button>
                            </form>
                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
