<div>
    <div class="overflow-hidden flex items-center justify-center bg-gray-300">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-semibold leading-tight capitalize">Pedidos</h2>
                </div>

                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Radicado
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Fecha de entrega
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Valor
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$order->id}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$order->delivery_date->format('d/m/Y')}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap capitalize">{{$order->name}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$order->total}}</p>
                                        </td>
                                        <td class="flex justify-around px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button wire:click="details({{$order}})" type="button">
                                                Detalles
                                            </x-jet-button>
                                            @if ($order->state_id == 1)
                                                <x-jet-button wire:click="reschedule({{$order}})" type="button">
                                                    Reagendar
                                                </x-jet-button>
                                                <x-jet-danger-button wire:click="complaint({{$order}})" type="button">
                                                    Inconsistencia
                                                </x-jet-danger-button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr >
                                        <td class="text-center py-4 bg-white" colspan="5">
                                            No tienes pedidos.
                                        </td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                    @isset($orders)
                        {{$orders->links()}}
                    @endisset
                </div>
            </div>
        </div>

        @push('alerts')
            <script>
                Livewire.on('purchase-alert', (icon,title, text) => {
                    Swal.fire({
                        icon,
                        title,
                        text,
                    });
                });

                Livewire.on('claim', (icon,title, text) => {
                    Swal.fire({
                        icon,
                        title,
                        text,
                    });
                });
            </script>
        @endpush
    </div>

    <x-jet-dialog-modal wire:model="canReschedule">
        <x-slot name="title">
            Reagendar entrega
        </x-slot>
        <x-jet-validation-errors class="mb-4" />
        <x-slot name="content">
            {{-- <x-jet-label for="newDeliveryDate" value="{{ __('Nueva fecha de entrega') }}" /> --}}
            <input wire:model="newDeliveryDate" type="date" class="py-0 rounded" min="{{date("Y-m-d", strtotime("now"))}}" max="{{date("Y-m-d", strtotime("+2 week"))}}">
            @error('deliveryDate')
                <span>{{$message}}</span>
            @enderror
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="canComplaint">
        <x-jet-validation-errors class="mb-4" />
        <x-slot name="title">
            Describenos tu problema
        </x-slot>
        <x-slot name="content">
            <x-jet-label for="claim" value="{{ __('Descripción') }}" />
            <textarea wire:model.difer="claim" class="resize-none w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" rows="10">{{old('claim')}}</textarea>
        </x-slot>
        <x-slot name="footer">
            <x-jet-button type="button" wire:click="saveClaim" >
                Enviar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
