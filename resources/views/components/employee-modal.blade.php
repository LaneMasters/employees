@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="text-sm font-medium text-gray-600">
            {{-- {{ $title }} --}}
            {{ $usuario }}
        </div>

        <div class="mt-4 font-medium text-sm text-gray-600">
            {{ $content }}
            {{-- {{ $nombre }} --}}
        </div>

    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
