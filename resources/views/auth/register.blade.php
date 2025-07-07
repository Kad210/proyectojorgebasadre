<x-guest-layout>
    <!-- Contenedor principal -->
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <!-- Logo del Colegio -->
        <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-white">
            <img class="w-24 h-auto mr-2" src="{{ asset('images/logo.jpg') }}" alt="logo">
        </a>
        <!-- Tarjeta del Formulario -->
        <div class="w-full bg-gray-800 rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                    Crear una Cuenta Nueva
                </h1>

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-white">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 placeholder-gray-400" placeholder="Tu nombre" required :value="old('name')" autofocus>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-white">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 placeholder-gray-400" placeholder="nombre@colegio.com" required :value="old('email')">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-700 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Botón de Registrarse -->
                    <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Registrar Cuenta
                    </button>

                    <p class="text-sm font-light text-gray-400">
                        ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="font-medium text-red-500 hover:underline">Inicia sesión aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
