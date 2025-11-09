@props([
    'task' => null,
])

@php
    $borderClass = null;
    if ($task?->getDueStatus() == 'Vencido') {
        $borderClass = 'border border-red-500';
    }
@endphp

{{-- Card --}}
<div
    class="p-5 pt-4 pb-2 bg-secondary rounded-2xl flex flex-col gap-4 relative {{ $borderClass }}">
    {{-- Options --}}
    <div class="absolute top-4 right-4">
        <x-dropdown>
            <x-slot name="trigger">
                <button class="block py-1 px-2 hover:bg-tertiary aspect-square rounded-full transition">
                    <svg width="18" height="4" viewBox="0 0 18 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.75 2.75C9.30228 2.75 9.75 2.30228 9.75 1.75C9.75 1.19772 9.30228 0.75 8.75 0.75C8.19772 0.75 7.75 1.19772 7.75 1.75C7.75 2.30228 8.19772 2.75 8.75 2.75Z"
                            stroke="#EFEFEF" stroke-width="1.5" stroke-linejoin="round" />
                        <path
                            d="M15.75 2.75C16.3023 2.75 16.75 2.30228 16.75 1.75C16.75 1.19772 16.3023 0.75 15.75 0.75C15.1977 0.75 14.75 1.19772 14.75 1.75C14.75 2.30228 15.1977 2.75 15.75 2.75Z"
                            stroke="#EFEFEF" stroke-width="1.5" stroke-linejoin="round" />
                        <path
                            d="M1.75 2.75C2.30228 2.75 2.75 2.30228 2.75 1.75C2.75 1.19772 2.30228 0.75 1.75 0.75C1.19772 0.75 0.75 1.19772 0.75 1.75C0.75 2.30228 1.19772 2.75 1.75 2.75Z"
                            stroke="#EFEFEF" stroke-width="1.5" stroke-linejoin="round" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="/" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'edit-task'); selected = {{ Js::from([
                        'id' => $task?->id,
                        'title' => $task?->title,
                        'description' => $task?->description,
                        'status' => $task?->status,
                        'due_date' => $task?->due_date,
                    ]) }}">
                    Editar
                </x-dropdown-link>

                <x-dropdown-link href="/" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'delete-task'); selected = {{ Js::from([
                        'id' => $task?->id,
                        'title' => $task?->title,
                        'description' => $task?->description,
                        'status' => $task?->status,
                        'due_date' => $task?->due_date,
                    ]) }}">
                    Eliminar
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>

    {{-- Content --}}
    <div class="pr-6">
        <h3 class="text-lg mb-3">{{ $task?->title }}</h3>
        <p class="text-sm opacity-70">
            {{ $task?->description }}
        </p>
    </div>

    {{-- Author --}}
    <span class="flex items-center justify-center bg-primary rounded-full aspect-square p-1 text-dark text-sm w-[30px]" style="background: {{ $task?->user->getUserAKA()['color'] }}">
        {{ $task?->user->getUserAKA()['aka'] }}
    </span>

    {{-- Bottom --}}
    {{-- Top --}}
    <div class="flex justify-between items-center h-8">
        @if ($task?->isDueSoon())
            <span
                class="inline-flex items-center gap-2 uppercase text-gray-400 font-medium text-xs before:block before:aspect-square before:bg-red-500 before:w-2 before:rounded-full">
                {{ $task?->getDueStatus() }}
            </span>
        @endif

        <span class="opacity-70 ms-auto">
            {{ $task?->due_date }}
        </span>
    </div>
</div>
