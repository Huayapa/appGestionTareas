<nav class="grid grid-cols-3 sm:hidden fixed bottom-0 left-0 w-full bg-tertiary">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <div class="w-9 aspect-square">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                    fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
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
        </div>
    </x-nav-link>

    @if (request()->routeIs('dashboard'))
        <button
            class="bg-primary shadow-xl shadow-[#42C83C50] flex items-center justify-center rounded-full absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 aspect-square w-16"
            x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new-task')">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 14H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M14 21V7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    @endif

    <x-nav-link class="col-start-3" :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        <svg width="35" height="35" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 10.6665C14.2091 10.6665 16 8.87564 16 6.6665C16 4.45736 14.2091 2.6665 12 2.6665C9.79086 2.6665 8 4.45736 8 6.6665C8 8.87564 9.79086 10.6665 12 10.6665Z"
                fill="currentColor" />
            <path
                d="M20 18.1665C20 20.6515 20 22.6665 12 22.6665C4 22.6665 4 20.6515 4 18.1665C4 15.6815 7.582 13.6665 12 13.6665C16.418 13.6665 20 15.6815 20 18.1665Z"
                fill="currentColor" />
        </svg>
    </x-nav-link>
</nav>
