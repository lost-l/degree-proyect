<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 mb-5 mt-8">
    @isset($logo)
        <div>
            {{ $logo }}
        </div>
    @endisset

    <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-xl overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
