<div>
    <x-button wire:click="$set('openCrear', true)"><i class="fas fa-add mr-2"></i>Nuevo</x-button>
    <!--MODAL FORMULARIO CREAR -->
    <x-dialog-modal wire:model="openCrear">
        <x-slot name="title">
            Nuevo
        </x-slot>
        <x-slot name="content">
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
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
                    <input type="checkbox" value="Publicado" class="sr-only peer" wire:model="form.estado">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
                </label>
                <x-input-error for="form.estado" />
            </div>
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etiquetas</label>
            <div class="flex items-center justify-start">
                @foreach ($allTags as $item)
                    <div class="flex items-center mb-4 mr-4">
                        <input id="{{ $item->nombre }}" type="checkbox" value="{{ $item->id }}"
                            wire:model="form.tags"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="{{ $item->nombre }}"
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
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" wire:click='cancelar'>
                    <i class="fas fa-xmark mr-2"></i> Cancelar
                </button>
                <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg mx-2">
                    <i class="fas fa-paintbrush mr-2"></i> Limpiar
                </button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" wire:click='guardar'>
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

</div>
