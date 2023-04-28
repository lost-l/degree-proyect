<div>
    <div class="overflow-hidden flex items-center justify-center bg-gray-300">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-semibold leading-tight">Direcciones</h2>
                    @can('address.create')
                        <x-jet-button class="flex justify-center" wire:click="addNewAddress" type="button">
                            Agregar dirección
                        </x-jet-button>
                    @endcan
                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Dirección
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Localidad
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($addresses as $address)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$address->description}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$address->name}}</p>
                                        </td>
                                        <td class="flex justify-around px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button wire:click="openModal({{$address}})" type="button">
                                                Editar
                                            </x-jet-button>
                                            @can('address.destroy')
                                                <x-jet-danger-button wire:click="$emit('destroy-address', {{$address->id}})" type="button">
                                                    Eliminar
                                                </x-jet-danger-button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @empty
                                    <tr >
                                        <td class="text-center py-4 bg-white" colspan="3">
                                            No hay direcciones
                                        </td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                    @isset($addresses)
                        {{$addresses->links()}}
                    @endisset
                </div>
            </div>
        </div>

        @push('alerts')
            <script>
                Livewire.on('destroy-address', (id) =>{
                    Swal.fire({
                        title: 'Seguro?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('addresses','destroyAddress', id);
                        }
                    })
                });

            </script>
        @endpush
    </div>

    <x-jet-dialog-modal wire:model="updateCurrentAddress">
        <x-slot name="title">
            Dirreción
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descripción') }}" />
                <x-jet-input wire:model.difer="description" id="description" class="block mt-1 w-full" type="search" name="description" value="{{$address->description ?? ''}}" required autofocus autocomplete="description" />
            </div>
            <div class="mt-4">
                <x-jet-label for="locality" value="{{ __('Localidad') }}" />
                <select wire:model.difer="locality" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="locality" id="locality">
                    @empty($addresses)
                        @foreach ($localities as $locality)
                            <option
                                value="{{$locality->id}}"
                                @selected($address->name == $locality->name)>
                                    {{$locality->name}}
                            </option>
                        @endforeach
                    @else
                        @foreach ($localities as $locality)
                            <option
                                value="{{$locality->id}}">
                                    {{$locality->name}}
                            </option>
                        @endforeach
                    @endempty

                </select>
            </div>
        </x-slot>

        <x-slot name="footer" >
            <x-jet-button class="flex justify-center" wire:click="updateAddress({{$address->id ?? '0'}})" type="button">
                Guardar
            </x-jet-button>
            <x-jet-danger-button wire:click="$set('updateCurrentAddress', false)" type="button">
                Cancelar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
