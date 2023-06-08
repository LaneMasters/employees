<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <x-button wire:click="$set('open', true)" class="bg-blue-400">
        Crear nuevo empleado
    </x-button>

    <x-employee-modal wire:model="open">
        <x-slot name="title">
            Crear Nuevo Empleado

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mb-4" alt="">
            @endif
        </x-slot>

        
        <x-slot name="usuario">
            <div class="my-3">
                <x-label value="Cuenta de usuario" class="mb-1" />
                <x-input type="text" placeholder="jsmith" class="w-full" wire:model.defer="usuario" />
                {{-- {{$usuario}} sin defer se muestra lo q escribo --}}
                <x-input-error for="usuario" />
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="my-3">
                <x-label value="Nombre completo" class="mb-1" />
                <x-input type="text" placeholder="Roberto Castillo" class="w-full" wire:model.defer="nombre" />
                <x-input-error for="nombre" />
            </div>

            <div class="my-3">
                <x-label value="Email" class="mb-1" />
                <x-input type="email" placeholder="nombre@correo.com" class="w-full" wire:model.defer="email" />
                <x-input-error for="email" />
            </div>

            <div class="my-3">
                <x-label value="Descripción" class="mb-1" />
                <textarea wire:model.defer="content" rows="10" placeholder="Breve descripción de su persona" class="w-full max-h-40"></textarea>
                <x-input-error for="content" />
            </div>

            <div class="my-3">
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-input-error for="image" />
            </div>

            <div wire:loading wire:target="image" class="w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando</strong>
                <span class="block sm:inline">espere un momento por favor.</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>

        </x-slot>

       
        <x-slot name="footer">
            <x-secondary-button class="mr-3" wire:click="$set('open', false)">
                cancelar
            </x-secondary-button>

            <x-danger-button 
                class="mr-3 disabled:opacity-25" 
                wire:click="save" 
                wire:loading.attr="disabled" wire:target="save,image">

                Grabar Empleado
            </x-danger-button>

            <span wire:loading wire:target="save">Espere un momento por favor...</span>
        </x-slot>
    </x-employee-modal>

</div>
