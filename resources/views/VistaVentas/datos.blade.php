@extends('navegador')

@section('Contenido')
<form class="p-6 flex flex-col justify-center" action="{{Route('Venta.storeCRUD')}}" method="POST">
        @csrf
        @method('POST')

        <div class="flex flex-col mt-2">
            <label for="fpago" class="hidden">Forma de pago:</label>
            <input type="text" name="fpago" id="fpago" value="CREDITO 30 DIAS DESPUES DE LA FACTURACION"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <div class="flex flex-col mt-2">
            <label for="cheque" class="hidden">CHUEQUE A NOMBRE DE:</label>
            <input type="text" name="cheque" id="cheque" value="ERNESTO EDIL CLAROS MELGAR"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <div class="flex flex-col mt-2">
            <label for="cuenta" class="hidden">TRANSFERENCIA BANCARIA:</label>
            <input type="text" name="cuenta" id="cuenta" value="NRO DE CUENTA BS 2000121455 BANCO NACIONAL DE BOLIVIA (BNB)"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <div class="flex flex-col mt-2">
            <label for="entrega" class="hidden">Lugar de Entrega:</label>
            <input type="text" name="entrega" id="entrega" value="DONDE INDIQUE EL CLIENTE"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <div class="flex flex-col mt-2">
            <label for="nota" class="hidden">Nota:</label>
            <input type="text" name="nota" id="nota" value="Al momento de emitir su Orden de Compra, favor de adjutar la presente cotización."
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <div class="flex flex-col mt-2">
            <label for="tc" class="hidden">Tipo de Cambio:</label>
            <input type="decimal" name="tc" id="tc" value="6.96"
                class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 dark:text-gray-50 font-semibold focus:border-blue-500 focus:outline-none" />
        </div>

        <button type="submit"
            class="md:w-32 bg-blue-600 dark:bg-gray-100 text-white dark:text-gray-800 font-bold py-3 px-6 rounded-lg mt-4 hover:bg-blue-500 dark:hover:bg-gray-200 transition ease-in-out duration-300">Registrar</button>
    </form>

@endsection
