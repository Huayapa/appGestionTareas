<x-app-layout>
    {{-- Top Nav --}}
    <div class="flex justify-end mb-12">
        <x-dropdown>
            <x-slot name="trigger">
                <button class="flex bg-primary rounded-full aspect-square p-2 text-dark">
                    DV
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    Perfil
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl">Tareas</h1>

        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new-task')">
            Añadir Tarea
        </x-primary-button>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__pending">
            <span class="w-fit bg-red-600 px-2 py-1 rounded-lg mb-6">Pendiente</span>

            <div class="flex flex-col gap-3">
                {{-- Card --}}
                <div class="p-5 py-3 pb-5 bg-secondary rounded-2xl flex flex-col gap-4">
                    {{-- Top --}}
                    <div class="flex justify-between items-stretch">
                        <span
                            class="inline-flex items-center gap-2 uppercase text-gray-400 font-medium text-xs before:block before:aspect-square before:bg-red-500 before:w-2 before:rounded-full">
                            Vence Pronto
                        </span>

                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="block py-1 px-2 hover:bg-tertiary aspect-square rounded-full transition">
                                    <svg width="18" height="4" viewBox="0 0 18 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                    x-on:click.prevent="$dispatch('open-modal', 'edit-task')">
                                    Editar
                                </x-dropdown-link>

                                <x-dropdown-link href="/" x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'delete-task')">
                                    Eliminar
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- Content --}}
                    <div>
                        <h3 class="text-lg mb-3">Implement design screens</h3>
                        <p class="text-sm opacity-70">
                            Create a design system for a hero section in 2 different variants. Create a
                            simple presentation with these components.
                        </p>
                    </div>

                    {{-- Author --}}
                    <span
                        class="flex items-center justify-center bg-primary rounded-full aspect-square p-1 text-dark text-sm w-[30px]">
                        DV
                    </span>

                </div>
            </div>
        </div>

        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__inprogress">
            <span class="w-fit bg-yellow-600 px-2 py-1 rounded-lg">En Progreso</span>
        </div>

        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__done">
            <span class="w-fit bg-green-600 px-2 py-1 rounded-lg">Realizado</span>
        </div>

        <x-modal name="edit-task" focusable>
            <form method="post" action="{{ route('tasks.store') }}" class="p-6">
                @csrf
                @method('PUT')

                <h2 class="text-xl font-medium">
                    Editar tarea
                </h2>

                {{-- Title --}}
                <div class="mt-6">
                    <x-input-label for="title" value="Titulo" />
                    <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" dark
                        placeholder="Implementar diseño..." required />

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <x-input-label for="description" value="Descripción" />
                    <x-textarea-input id="description" name="description" class="mt-2 block w-full" dark
                        placeholder="Crear un nuevo diseño para los..." required />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Status --}}
                    <div class="mt-6">
                        <x-input-label for="status" value="Estado" />
                        <x-select-input id="status" name="status" class="mt-2 block w-full" dark required>
                            <option>Seleccione un estado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="en progreso">En Progreso</option>
                            <option value="completada">Completada</option>
                        </x-select-input>

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Due Date --}}
                    <div class="mt-6">
                        <x-input-label for="due_date" value="Titulo" />
                        <x-text-input id="due_date" name="due_date" type="date" class="mt-2 block w-full" dark
                            placeholder="Implementar diseño..." required min="{{ now()->format('Y-m-d') }}"
                            value="{{ now()->format('Y-m-d') }}" />

                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        Crear Tarea
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <x-modal name="delete-task" focusable>
            <form method="post" action="{{ route('tasks.store') }}" class="p-6">
                @csrf
                @method('PUT')

                <h2 class="text-xl font-medium">
                    Editar tarea
                </h2>

                {{-- Title --}}
                <div class="mt-6">
                    <x-input-label for="title" value="Titulo" />
                    <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" dark
                        placeholder="Implementar diseño..." required />

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <x-input-label for="description" value="Descripción" />
                    <x-textarea-input id="description" name="description" class="mt-2 block w-full" dark
                        placeholder="Crear un nuevo diseño para los..." required />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Status --}}
                    <div class="mt-6">
                        <x-input-label for="status" value="Estado" />
                        <x-select-input id="status" name="status" class="mt-2 block w-full" dark required>
                            <option>Seleccione un estado</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="en progreso">En Progreso</option>
                            <option value="completada">Completada</option>
                        </x-select-input>

                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Due Date --}}
                    <div class="mt-6">
                        <x-input-label for="due_date" value="Titulo" />
                        <x-text-input id="due_date" name="due_date" type="date" class="mt-2 block w-full" dark
                            placeholder="Implementar diseño..." required min="{{ now()->format('Y-m-d') }}"
                            value="{{ now()->format('Y-m-d') }}" />

                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        Crear Tarea
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>

    <x-modal name="create-new-task" focusable>
        <form method="post" action="{{ route('tasks.store') }}" class="p-6">
            @csrf

            <h2 class="text-xl font-medium">
                Crear nueva tarea
            </h2>

            {{-- Title --}}
            <div class="mt-6">
                <x-input-label for="title" value="Titulo" />
                <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" dark
                    placeholder="Implementar diseño..." required />

                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mt-6">
                <x-input-label for="description" value="Descripción" />
                <x-textarea-input id="description" name="description" class="mt-2 block w-full" dark
                    placeholder="Crear un nuevo diseño para los..." required />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-6">
                {{-- Status --}}
                <div class="mt-6">
                    <x-input-label for="status" value="Estado" />
                    <x-select-input id="status" name="status" class="mt-2 block w-full" dark required>
                        <option>Seleccione un estado</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en progreso">En Progreso</option>
                        <option value="completada">Completada</option>
                    </x-select-input>

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Due Date --}}
                <div class="mt-6">
                    <x-input-label for="due_date" value="Titulo" />
                    <x-text-input id="due_date" name="due_date" type="date" class="mt-2 block w-full" dark
                        placeholder="Implementar diseño..." required min="{{ now()->format('Y-m-d') }}"
                        value="{{ now()->format('Y-m-d') }}" />

                    <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    Crear Tarea
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
