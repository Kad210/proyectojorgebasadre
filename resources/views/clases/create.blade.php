->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Añadir Nueva Clase
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Muestra aquí los errores de validación -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('clases.store') }}">
                        @csrf <!-- Token de seguridad de Laravel -->

                        <!-- Grado -->
                        <div>
                            <label for="grado">Grado</label>
                            <input id="grado" class="block mt-1 w-full" type="text" name="grado" :value="old('grado')" required autofocus placeholder="Ej: 1ro de Secundaria" />
                        </div>

                        <!-- Sección -->
                        <div class="mt-4">
                            <label for="seccion">Sección</label>
                            <input id="seccion" class="block mt-1 w-full" type="text" name="seccion" :value="old('seccion')" required placeholder="Ej: A" />
                        </div>

                        <!-- Selector de Profesor -->
                        <div class="mt-4">
                            <label for="user_id">Asignar Profesor</label>
                            <select name="user_id" id="user_id" class="block mt-1 w-full">
                                <option value="">-- Seleccione un profesor --</option>
                                <!-- El controlador nos pasa la variable $profesores -->
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Guardar Clase
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
