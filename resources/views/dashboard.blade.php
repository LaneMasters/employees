<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}
            
            {{-- al hacer esto llama a mi h1 de show-employye.blade, llama a la tabla y todo lo que ponga en sa vista --}}
            @livewire('show-employee')

            
        </div>
    </div>
</x-app-layout>
