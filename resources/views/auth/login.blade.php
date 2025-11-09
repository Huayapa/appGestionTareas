<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center w-full lg:gap-24">
        <div class="hidden md:block relative">
            <img src="{{ asset('img/login-image.png') }}" alt="Imagen del login" class="animate-beat-slow">
            <img src="{{ asset('img/watch.png') }}" alt="Reloj" class="animate-beat-reverse absolute top-0 left-[80px]">
            <img src="{{ asset('img/pie.png') }}" alt="Tarta" class="animate-beat-reverse absolute top-1/3 left">
            <img src="{{ asset('img/coffee.png') }}" alt="Café"
                class="animate-beat absolute bottom-[100px] right-[100px]">
            <img src="{{ asset('img/calendar.png') }}" alt="Calendario"
                class="animate-beat-reverse absolute top-1/4 right-20">
            <img src="{{ asset('img/vase.png') }}" alt="Jarrón"
                class="animate-beat absolute bottom-[60px] left-[40px]">
        </div>
        <div class="flex flex-col p-5 py-10 md:py-5 max-w-[430px] w-full">
            <h1 class="text-3xl font-bold text-center sm:text-left">Iniciar Sesión</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mt-6">
                    <x-input-label for="email" value="Correo electrónico" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" placeholder="example@gmail.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="Contraseña" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="******" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                        <span class="ms-2 text-sm text-light">Recuérdame</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="underline self-end text-light opacity-70 hover:opacity-100 active:text-primary transition text-sm"
                            href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <div class="flex flex-col justify-end mt-6 gap-4">
                    <span class="text-sm">
                        ¿No tienes una cuenta?

                        <a class="underline text-light opacity-70 hover:opacity-100 active:text-primary transition"
                            href="{{ route('register') }}">
                            Regístrate aquí
                        </a>
                    </span>


                    <x-primary-button class="w-full h-[60px] rounded-2xl">
                        Iniciar sesión
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
