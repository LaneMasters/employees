<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <h1>Mi Aplicación de Empleados</h1>

    {{-- {{$employees}} se muestra en pantalla los registros d emi tabla--}}

    {{-- <input type="text" wire:model="search"> --}}
    {{-- {{$search}} --}}

    <div class="flex items-center mt-10 justify-end">
        <x-input type="text" wire:model="search" class="mr-3" placeholder="Ingrese su búsqueda" />
        
        @livewire('create-employee')
    </div>

    <x-table>
        {{-- QUEDA PENDIENTE EL CONDICIONAL --}}
        @if(count($employees))
        
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase text-center dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th wire:click="order('id')" scope="col" class="cursor-pointer px-6 py-3">
                            Id
                            @if($sort == 'id')
                                @if($direction == 'desc')
                                    <i class="fa fa-sort-numeric-asc float-right"></i>
                                @else
                                    <i class="fa fa-sort-numeric-desc float-right"></i>
                                @endif
                            @else
                                <i class="fa fa-sort float-right"></i>
                            @endif
                        </th>

                        <th wire:click="order('usuario')" scope="col" class="cursor-pointer px-6 py-3">
                            Usuario
                            @if($sort == 'usuario')
                                @if($direction == "desc")
                                    <i class="fa fa-sort-alpha-asc float-right"></i>
                                @else
                                    <i class="fa fa-sort-alpha-desc float-right"></i>
                                @endif
                            @else
                                <i class="fa fa-sort float-right"></i>
                            @endif
                        </th>

                        <th wire:click="order('nombre')" scope="col" class="cursor-pointer px-6 py-3">
                            Nombre
                            @if($sort == 'nombre')
                                @if($direction == "desc")
                                    <i class="fa fa-sort-alpha-asc float-right" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-sort-alpha-desc float-right" aria-hidden="true"></i>
                                @endif
                            @else
                                <i class="fa fa-sort float-right"></i>
                            @endif
                        </th>
                        {{-- <th scope="col" class="px-6 py-3">
                            
                        </th> --}}
                    </tr>
                </thead>
                <tbody>

                    @foreach($employees as $employee)
                    
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 text-center">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$employee->id}}
                            </th>

                            <td class="px-6 py-4">
                                {{$employee->usuario}}
                            </td>

                            <td class="px-6 py-4 ">
                                {{$employee->nombre}}
                            </td>

                            <td class="px-6 py-4 ">
                                {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                
                                {{-- el $employee que pongo es el wire:click edit esta en el foreach --}}
                                <a wire:click="edit({{$employee}})" class="btn btn-blue text-white" title="Editar"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-gray text-white" title="Mostrar"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-red text-white" title="Eliminar"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                    @endforeach
                
                </tbody>
            </table>

            {{-- condicional para paginacion --}}
            @if($employees->hasPages())
                <div class="p-3">
                    {{$employees->links()}}
                </div>
            @endif

        @else
            <span class="px-8 text-lg text-red-500">No existe ningún registro</span>
        @endif
        
    </x-table>


    {{-- MODAL PARA EDITAR EMPLEADOS --}}
    <x-employee-modal wire:model="open_edit">
        <x-slot name="title">
            Actualizar Empleado {{$empleado->nombre}}

            @if($image)
                <img src="{{ $image->temporaryUrl() }}" class="mb-4" alt="">
            @else 
                <img src="{{Storage::url($empleado->image)}}" alt="">
            @endif
        </x-slot>

        
        <x-slot name="usuario">
            <div class="my-3">
                <x-label value="Cuenta de usuario" class="mb-1" />
                <x-input type="text" class="w-full" wire:model="empleado.usuario" />
                {{-- {{$usuario}} sin defer se muestra lo q escribo --}}
                <x-input-error for="usuario" />
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="my-3">
                <x-label value="Nombre completo" class="mb-1" />
                <x-input type="text"  class="w-full" wire:model="empleado.nombre" />
                <x-input-error for="nombre" />
            </div>

            <div class="my-3">
                <x-label value="Email" class="mb-1" />
                <x-input type="email"  class="w-full" wire:model="empleado.email" />
                <x-input-error for="email" />
            </div>

            <div class="my-3">
                <x-label value="Descripción" class="mb-1" />
                <textarea wire:model="empleado.content" rows="10" class="w-full max-h-40"></textarea>
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
            <x-secondary-button class="mr-3" wire:click="$set('open_edit', false)">
                cancelar
            </x-secondary-button>

            <x-danger-button 
                class="mr-3 disabled:opacity-25" 
                wire:click="update" 
                wire:loading.attr="disabled" wire:target="update,image">

                Actualizar Empleado
            </x-danger-button>

            <span wire:loading wire:target="update">Espere un momento por favor...</span>
        </x-slot>
    </x-employee-modal>

</div>
