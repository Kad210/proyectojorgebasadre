<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestionar Sitios Bloqueados para: {{ $clase->grado }} - "{{ $clase->seccion }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulario para añadir nuevo sitio -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Añadir Nuevo Sitio a la Lista Negra</h3>
                    <form action="{{ route('sitios.store', $clase) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="url">URL del Sitio Web</label>
                                <input type="url" name="url" id="url" class="block mt-1 w-full" placeholder="https://www.youtube.com" required>
                            </div>
                            <div>
                                <label for="razon_bloqueo">Razón del Bloqueo</label>
                                <input type="text" name="razon_bloqueo" id="razon_bloqueo" class="block mt-1 w-full" placeholder="Distracción" required>
                            </div>
                            <div class="self-end">
                                <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">Bloquear Sitio</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de sitios ya bloqueados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Sitios Bloqueados Actualmente</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>URL</th>
                                <th>Razón</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sitios as $sitio)
                                <tr>
                                    <td class="px-6 py-4">{{ $sitio->url }}</td>
                                    <td class="px-6 py-4">{{ $sitio->razon_bloqueo }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('sitios.destroy', $sitio) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres desbloquear este sitio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-green-600 hover:text-green-900">Desbloquear</button>
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
