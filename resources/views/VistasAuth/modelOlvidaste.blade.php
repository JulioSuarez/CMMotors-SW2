<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


<hr class="" />
<div class="text-center "
    x-data="{ modelOpen: false }">
    {{-- @error('correoRestore')  <p class="text-red-600">*{{$message}}</p> @enderror --}}

    <button  @click="modelOpen =!modelOpen"
    class="font-medium text-indigo-600 hover:text-indigo-500"
        href="">
        Olvidaste tu contrasena?
    </button>

    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelOpen = true" x-show="modelOpen"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelOpen"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">Restablecer Contrasena</h1>

                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>

            {{-- <form action="#" method="GET"> --}}

                <div id="contra" class="mb-4 mt-6">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="emailRestore">
                        Introdusca su Correo Electronico
                    </label>
                    <input
                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        id="emailRestore"
                        type="email"
                        name="emailRestore"
                        value='{{old('correo_electronico')}}'
                        required autofocus
                        placeholder="Ejemplo007@gmail.com"
                        aria-label="email" required
                    />
                    @error('correoRestore')  <p class="text-red-600">*{{$message}}</p> @enderror
                </div>
                {{-- <div class="mb-6 text-center">
                    <button id="contra"
                        class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                        type="submit">
                        Entrar
                    </button>
                </div>
            </form> --}}


             </div> {{-- end open model --}}
        </div> {{-- felx item--}}
    </div> {{-- open model padre --}}


</div>{{-- end de model --}}

