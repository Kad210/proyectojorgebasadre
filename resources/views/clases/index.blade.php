<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Clases
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito después de crear una clase -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Botón para ir al formulario de creación -->
                    <div class="mb-4">
                        <a href="{{ route('clases.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Añadir Nueva Clase
                        </a>
                    </div>

                    <!-- Tabla para listar las clases -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">API Key</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profesor Asignado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($clases as $clase)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $clase->api_key }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $clase->grado }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $clase->seccion }}</td>
                                    <!-- Usamos la relación 'profesor' que definimos en el modelo -->
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $clase->profesor->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <!-- Enlace para Editar -->
                                    <a href="{{ route('clases.edit', $clase) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>

                                    <!-- Formulario para Eliminar -->
                                        <form action="{{ route('clases.destroy', $clase) }}" method="POST" class="inline ml-4" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta clase?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
