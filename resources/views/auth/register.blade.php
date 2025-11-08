<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center w-full lg:gap-24">
        <div class="flex flex-col p-5 py-10 md:py-5 max-w-[430px] w-full">
            <h1 class="text-3xl font-bold text-center sm:text-left">Crear una cuenta</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mt-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex flex-col items-start justify-end mt-4 gap-4">
                    <a class="underline text-light opacity-70 hover:opacity-100 active:text-primary transition text-sm"
                        href="{{ route('login') }}">
                        ¿Ya tienes una cuenta?
                    </a>

                    <x-primary-button class="w-full h-[60px] rounded-2xl">
                        Registrarse
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="hidden md:block relative">
            <img src="{{ asset('img/login-image.png') }}" alt="Imagen del login" class="animate-beat-slow">
            <img src="{{ asset('img/watch.png') }}" alt="Reloj"
                class="animate-beat-reverse absolute top-0 left-[80px]">
            <img src="{{ asset('img/pie.png') }}" alt="Tarta" class="animate-beat-reverse absolute top-1/3 left">
            <img src="{{ asset('img/coffee.png') }}" alt="Café"
                class="animate-beat absolute bottom-[100px] right-[100px]">
            <img src="{{ asset('img/calendar.png') }}" alt="Calendario"
                class="animate-beat-reverse absolute top-1/4 right-20">
            <img src="{{ asset('img/vase.png') }}" alt="Jarrón"
                class="animate-beat absolute bottom-[60px] left-[40px]">
        </div>
    </div>
</x-guest-layout>
