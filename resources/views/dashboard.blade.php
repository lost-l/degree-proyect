<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="px-4 sm:px-8 py-4">
                    <p class="flex justify-center items-center text-sm border-2 border-transparent rounded-full outline-none border-gray-300 transition scale-150 py-4 bg-gray-500">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </p>
                    <h2 class="pt-8 text-2xl font-semibold leading-tight">Datos</h2>
                    <p class="p-4">
                        <strong>Nombre: </strong>{{Auth::user()->name}} <br>
                        <strong>Apellido: </strong>{{Auth::user()->surname}} <br>
                        <strong>Telefono: </strong>{{Auth::user()->phone}} <br>
                        <strong>Correo: </strong>{{Auth::user()->email}} <br>
                    </p>
                </section>
                <livewire:addresses />
                <livewire:orders />
            </div>
        </div>
    </div>
</x-app-layout>
