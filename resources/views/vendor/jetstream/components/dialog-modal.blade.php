@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:flex-wrap sm:justify-between p-6">
        {{ $footer }}
    </div>
</x-jet-modal>
