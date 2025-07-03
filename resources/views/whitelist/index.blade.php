<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Lista Blanca Global
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
                    <h3 class="text-lg font-medium mb-4">Añadir Sitio a la Lista Blanca</h3>
                    <p class="text-sm text-gray-600 mb-4">Los sitios en esta lista NUNCA serán bloqueados, sin importar la configuración del profesor.</p>
                    <form action="{{ route('whitelist.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="url">URL del Sitio Web</label>
                                <input type="url" name="url" id="url" class="block mt-1 w-full" placeholder="https://www.wikipedia.org" required>
                            </div>
                            <div>
                                <label for="motivo">Motivo</label>
                                <input type="text" name="motivo" id="motivo" class="block mt-1 w-full" placeholder="Plataforma Educativa" required>
                            </div>
                            <div class="self-end">
                                <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">Añadir Sitio</button>
                            </div>
                        </div>
                         @error('url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </form>
                </div>
            </div>

            <!-- Lista de sitios ya permitidos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Sitios Permitidos Actualmente</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>URL</th>
                                <th>Motivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sitiosPermitidos as $sitio)
                                <tr>
                                    <td class="px-6 py-4">{{ $sitio->url }}</td>
                                    <td class="px-6 py-4">{{ $sitio->motivo }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('whitelist.destroy', $sitio) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres quitar este sitio de la lista blanca?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Quitar</button>
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
