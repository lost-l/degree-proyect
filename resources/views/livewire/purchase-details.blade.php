<div class="flex flex-col">
    <section class="py-5">
        <h2 class="text-center font-semibold text-2xl">Pedido</h2>
    </section>
    <section class="pt-5 flex flex-col sm:flex-row justify-around space-y-8 sm:space-y-0 mb-14">
        <ul class="ml-7 sm:ml-0">
            <li>
                <strong>Radicado: </strong> {{$order->id}}
            </li>
            <li>
                <strong>Nombre: </strong> {{$order->user->name}}
            </li>
            <li>
                <strong>Dirección: </strong> {{$order->address}}
            </li>
            <li>
                <strong>Teléfono: </strong> {{$order->user->phone}}
            </li>
        </ul>
        <ul class="ml-7 sm:ml-0">
            <li>
                <strong>Fecha de entrega: </strong> {{$order->delivery_date->format('d/m/Y')}}
            </li>
            <li class="capitalize">
                <strong>Estado: </strong> {{$order->state->name}}
            </li>
            <li>
                <strong>Total: </strong> &dollar; {{$order->total}}
            </li>
            <li>
                <strong>Fecha de elaboración: </strong> {{$order->created_at->format('d/m/Y g:i a')}}
            </li>
        </ul>
    </section>

    <div class="overflow-hidden flex items-center justify-center bg-gray-300">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Cantidad
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        Precio unitario
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        Total
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                        Opción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$product->name}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$product->pivot->quantity}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$product->pivot->price}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{$product->pivot->price * $product->pivot->quantity}}</p>
                                        </td>
                                        <td class="flex justify-around px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button wire:click="seeProduct({{$product->pivot->product_id}})" type="button">
                                                Ver producto
                                            </x-jet-button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr >
                                        <td class="text-center py-4 bg-white" colspan="3">
                                            No hay productos
                                        </td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                    @isset($products)
                        {{$products->links()}}
                    @endisset
                </div>
            </div>
        </div>
    </div>

    
    @if ($order->claim)
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <h3 class="font-semibold text-2xl">{{__('Reclamo')}}</h3>
                <p class="">{{$order->claim}}</p>
            </div>
        </div>
    @endif

    <section class="flex flex-col sm:flex-row justify-evenly pt-12">

        @if ($order->state_id == 1)
            @if (auth()->user()->hasRole('delivery'))
                <x-jet-button wire:click="$emit('finishOrder')" type="button" class="uppercase">
                    Pedido realizadó
                </x-jet-button>
            @endif
                <x-jet-danger-button wire:click="$emit('cancelOrder')" type="button" class="uppercase">
                    Cancelar pedido
                </x-jet-danger-button>
        @endif
    </section>

    @push('alerts')
        <script>
            Livewire.on('finishOrder', () => {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Entrega realizada?',
                    text: 'Se efectuó la entrega',
                    showCancelButton: true,
                    confirmButtonText : 'Si',
                }).then(result =>{
                    if (result.isConfirmed) {
                        livewire.emit('finish')
                    }
                });
            })

            Livewire.on('cancelOrder', () => {
                Swal.fire({
                    icon: 'warning',
                    title: '¿Cancelar el pedido?',
                    text: 'Deseas cancelar el pedido',
                    showCancelButton: true,
                    confirmButtonText : 'Si',
                }).then(result =>{
                    if (result.isConfirmed) {
                        livewire.emit('cancel')
                    }
                });
            })
        </script>
    @endpush
</div>
