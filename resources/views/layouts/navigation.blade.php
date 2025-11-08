<nav class="bg-dark hidden md:flex rounded-xl sticky-navigation">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-col justify-between w-full">
        <div class="flex flex-col">
            <!-- Logo -->
            <div class="shrink-0 flex items-center justify-center px-5 pt-5">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex flex-col gap-3 mt-10">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                            fill="#42C83C" stroke="#42C83C" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12.37 8.87988H17.62" stroke="#343434" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.38 8.87988L7.13 9.62988L9.38 7.37988" stroke="#343434" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.37 15.8799H17.62" stroke="#343434" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.38 15.8799L7.13 16.6299L9.38 14.3799" stroke="#343434" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Tareas
                </x-nav-link>
                <x-nav-link :href="route('dashboard')">
                    Perfil
                </x-nav-link>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="p-5">
            @csrf
            <x-danger-button class="w-full">
                Cerrar sesión
            </x-danger-button>
        </form>
    </div>
</nav>
