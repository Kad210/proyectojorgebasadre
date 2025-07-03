<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Clases Asignadas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Bienvenido, {{ Auth::user()->name }}.</h3>
                    <p class="mb-6">Desde aquí puedes gestionar los sitios bloqueados y ver la información de cada una de tus clases.</p>

                    @if($clases->isEmpty())
                        <p>Aún no tienes ninguna clase asignada.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($clases as $clase)
                                <div class="bg-gray-100 p-4 rounded-lg shadow flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-lg">{{ $clase->grado }} - Sección "{{ $clase->seccion }}"</h4>

                                        <!-- ===== INICIO DE LA MODIFICACIÓN ===== -->
                                        <p class="text-xs text-gray-500 mt-2">API Key:</p>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <input type="text" readonly id="apiKey-{{ $clase->id }}" value="{{ $clase->api_key }}" class="w-full bg-gray-200 border-none rounded-md text-xs p-1">
                                            <button onclick="copyApiKey({{ $clase->id }})" class="p-1 bg-gray-300 rounded-md hover:bg-gray-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                            </button>
                                        </div>
                                        <span id="copy-status-{{ $clase->id }}" class="text-xs text-green-600"></span>
                                        <!-- ===== FIN DE LA MODIFICACIÓN ===== -->

                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('sitios.index', $clase) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                                            Gestionar Sitios Bloqueados
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Script para el botón de copiar -->
    <script>
        function copyApiKey(claseId) {
            const input = document.getElementById('apiKey-' + claseId);
            const status = document.getElementById('copy-status-' + claseId);

            input.select();
            input.setSelectionRange(0, 99999); // Para dispositivos móviles

            try {
                document.execCommand('copy');
                status.textContent = '¡Copiado!';
                setTimeout(() => { status.textContent = ''; }, 2000);
            } catch (err) {
                status.textContent = 'Error al copiar';
            }
        }
    </script>
</x-app-layout>
