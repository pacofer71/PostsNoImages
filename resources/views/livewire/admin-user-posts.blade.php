<x-principal>
    <div class="flex mb-2 w-full items-center justify-between">
        <div class="relative w-3/4">
            <input type="search" wire:model.live='search' placeholder="Buscar..."
                class="w-full pl-10 pr-4 py-2 border rounded-lg" />
            <div
                class="absolute inset-y-0 left-0 pl-3  
                    flex items-center  
                    pointer-events-none">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div>
            @livewire('create-post')
        </div>
    </div>
    @if ($posts->count())
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                            <i class="fas fa-sort mr-1"></i>Título
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('contenido')">
                            <i class="fas fa-sort mr-1 "></i>Contenido
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                            <i class="fas fa-sort mr-1"></i>Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tags
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->titulo }}
                            </th>
                            <td class="px-6 py-4 font-sans">
                                {{ $item->contenido }}
                            </td>
                            <td @class([
                                'px-6 py-4 font-bold',
                                'text-green-600' => $item->estado == 'Publicado',
                                'text-red-600 line-through' => $item->estado == 'Borrador',
                            ])>
                                <p class="px-2 py-1 rounded-lg bg-gray-200 cursor-pointer"
                                    wire:click="cambiarEstado({{ $item->id }})">{{ $item->estado }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    @foreach ($item->tags as $tag)
                                        <div class="mt-1 px-2 py-1 rounded-lg text-black"
                                            style="background-color:{{ $tag->color }}">
                                            #{{ $tag->nombre }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button wire:click="editar({{ $item->id }})">
                                    <i class="fas fa-edit text-purple-500 text-sm hover:text-lg"></i>
                                </button>
                                <button wire:click="preguntarBorrar({{ $item->id }})">
                                    <i class="fas fa-trash text-red-500 text-sm hover:text-lg"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-1">
            {{ $posts->links() }}
        </div>
    @else
        <p class='p-4 rounded-xl shadow-xl text-purple-400 bg-gray-100 text-lg font-semibold border-2 border-gray-300'>
            No se encontró ningún post o aun no creo ninguno.
        </p>
    @endif
    <!---------------------------------------------------------- MODAL FORMULARIO EDITAR -------------------------------------------------------------------->
    @if ($this->form->miPost != null)
        <x-dialog-modal wire:model="openEditar">
            <x-slot name="title">
                Editar Post
            </x-slot>
            <x-slot name="content">
                <div class="mb-5">
                    <label for="titulo"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                    <input type="text" id="titulo" wire:model="form.titulo"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Título ..." required />
                    <x-input-error for="form.titulo" />
                </div>
                <div class="mb-5">
                    <label for="contenido"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido</label>
                    <textarea wire:model="form.contenido" id="contenido" rows='10' placeholder='Contenido...'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    <x-input-error for="form.contenido" />
                </div>
                <div class="mb-5">
                    <label for=""
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                    <label class="inline-flex items-center mb-5 cursor-pointer">

                        <input type="checkbox" value="Publicado" class="sr-only peer" wire:model="form.estado"
                            @checked($form->estado == 'Publicado')>
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
                    </label>
                    <x-input-error for="form.estado" />
                </div>
                <label for=""
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etiquetas</label>
                <div class="flex items-center justify-start">
                    @foreach ($allTags as $item)
                        <div class="flex items-center mb-4 mr-4">
                            <input id="{{ $item->nombre }}_e" type="checkbox" value="{{ $item->id }}"
                                wire:model="form.tags"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="{{ $item->nombre }}_e"
                                class="ms-2 text-sm font-semibold text-gray-900 dark:text-gray-300 py-1 px-2 rounded-lg"
                                style="background-color:{{ $item->color }}">
                                #{{ $item->nombre }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="form.tags" />

            </x-slot>
            <x-slot name="footer">
                <div class="flex">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg mr-2"
                        wire:click='cancelar'>
                        <i class="fas fa-xmark mr-2"></i> Cancelar
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                        wire:click='update'>
                        <i class="fas fa-edit mr-2"></i> Editar
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

</x-principal>
