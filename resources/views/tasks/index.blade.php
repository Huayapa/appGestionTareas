<x-app-layout>

    <div class="sticky top-5 bg-secondary z-10">
        {{-- Top Nav --}}
        <div class="flex justify-end mb-12">
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="flex bg-primary rounded-full aspect-square p-2 text-dark">
                        {{ collect(explode(' ', Auth::user()->name))->take(2)->map(fn($word) => strtoupper($word[0]))->implode('') }}
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
        <div class="flex items-center justify-between pb-4 mb-4">
            <h1 class="text-3xl">Tareas</h1>
    
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new-task')">
                Añadir Tarea
            </x-primary-button>
        </div>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-3 gap-4" x-data="{ selected: null }">
        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__pending">
            <span class="w-fit bg-red-600 px-2 py-1 rounded-lg mb-6">Pendiente</span>

            <div class="flex flex-col gap-3">
                @isset($tasks['pendiente'])
                    @foreach ($tasks['pendiente'] as $task)
                        <x-task-card :task="$task" />
                    @endforeach
                @endisset
            </div>
        </div>

        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__inprogress">
            <span class="w-fit bg-yellow-600 px-2 py-1 rounded-lg mb-6">En Progreso</span>

            <div class="flex flex-col gap-3">
                @isset($tasks['en progreso'])
                    @foreach ($tasks['en progreso'] as $task)
                        <x-task-card :task="$task" />
                    @endforeach
                @endisset
            </div>
        </div>

        <div class="flex flex-col py-5 px-4 border-2 border-dashed rounded-xl card__done">
            <span class="w-fit bg-green-600 px-2 py-1 rounded-lg mb-6">Completada</span>

            <div class="flex flex-col gap-3">
                @isset($tasks['completada'])
                    @foreach ($tasks['completada'] as $task)
                        <x-task-card :task="$task" />
                    @endforeach
                @endisset
            </div>
        </div>

        <x-modal name="edit-task" focusable>
            <form method="post" action="{{ route('tasks.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <h2 class="text-xl font-medium">
                    Editar tarea - <span x-text="selected?.id"></span>
                </h2>

                {{-- Id --}}
                <input type="hidden" name="id" x-bind:value="selected?.id">

                {{-- Title --}}
                <div class="mt-6">
                    <x-input-label for="title" value="Titulo" />
                    <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" dark
                        placeholder="Implementar diseño..." required x-bind:value="selected?.title" />

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <x-input-label for="description" value="Descripción" />
                    <x-textarea-input id="description" name="description" class="mt-2 block w-full" dark
                        placeholder="Crear un nuevo diseño para los..." required x-text="selected?.description" />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-6">
                    {{-- Status --}}
                    <div class="mt-6">
                        <x-input-label for="status" value="Estado" />
                        <x-select-input id="status" name="status" class="mt-2 block w-full" dark required
                            x-bind:value="selected?.status">
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
                            placeholder="Implementar diseño..." required  x-bind:value="selected?.due_date" />

                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        Actualizar Tarea
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <x-modal name="delete-task" focusable>
            <form method="post" action="{{ route('tasks.destroy') }}" class="p-6">
                @csrf
                @method('DELETE')

                {{-- Id --}}
                <input type="hidden" name="id" x-bind:value="selected?.id">

                <h2 class="text-xl font-medium">
                    ¿Eliminar tarea - <span x-text="selected?.title"></span>?
                </h2>

                <p class="mt-2 opacity-70">Esta tarea se eliminará permanentemente. Esta acción es irreversible.</p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        Eliminar Tarea
                    </x-danger-button>
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
