<div class="py-2 px-4">
    @if ($products->count())
        <div class="overflow-hidden flex items-center justify-center ">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold leading-tight">
                                {{$user->name}} {{$user->surname}}
                            </h2>
                            <ul class="py-2">
                                <li class="mt-1"><strong>Cedula: </strong>{{$user->cc}}</li>
                                <li class="mt-1"><strong>Telefono: </strong>{{$user->phone}}</li>
                                <li class="mt-1"><strong>Metodo de pago: </strong>Contra entrega</li>
                                <li class="mt-1">
                                    <strong class="mr-2">Dirección: </strong>
                                    <select wire:model="addressId" class="py-0 rounded border-gray-400">
                                        @foreach ($addresses as $address)
                                            <option value="{{$address->id}}">
                                                {{$address->description}}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li class="mt-2">
                                    <strong class="mr-2">Fecha de entrega: </strong>
                                    <input wire:model="deliveryDate" type="date" class="py-0 rounded"
                                    min="{{date("Y-m-d", strtotime("now"))}}"
                                    max="{{date("Y-m-d", strtotime("+2 week"))}}">
                                    @error('deliveryDate')
                                        <span>{{$message}}</span>
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead >
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-400 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Descripción
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-400 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Cantidad
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-400 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Precio unitario
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-400 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{$product["name"]}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{$product["quantity"]}}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{$product["price"]}}</p>
                                            </td>
                                            <td class="flex justify-around px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{Cart::get($product["id"])->getPriceSum()}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="px-5 py-5 border-b border-gray-200 bg-gray-200 text-sm">
                                        <td colspan="2" class="">
                                            &nbsp;
                                        </td>
                                        <td class="sm:px-8 py-4">
                                            Subtotal
                                        </td>
                                        <td class="sm:px-8 py-4 text-center">
                                            {{$subtotal}}
                                        </td>
                                    </tr>
                                    <tr class="px-5 py-5 border-b border-gray-200 bg-gray-200 text-sm">
                                        <td colspan="2" class="">
                                            &nbsp;
                                        </td>
                                        <td class="sm:px-8 py-4">
                                            Envio
                                        </td>
                                        <td  class="sm:px-8 py-4 text-center">
                                            {{$envio}}
                                        </td>
                                    </tr>
                                    <tr class="px-5 py-5 border-b border-gray-200 bg-gray-200 text-sm">
                                        <td colspan="2" class="">
                                            &nbsp;
                                        </td>
                                        <td class="sm:px-8 py-4">
                                            Iva
                                        </td>
                                        <td class="sm:px-8 py-4 text-center">
                                            @if ($iva->is_active)
                                                {{explode('.', $iva->value)[0]}}%
                                            @else
                                                0%
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="px-5 py-5 border-b border-gray-200 bg-gray-200 text-sm">
                                        <td colspan="2" class="">
                                            &nbsp;
                                        </td>
                                        <td class="sm:px-8 py-4">
                                            Total
                                        </td>
                                        <td class="sm:px-8 py-4 text-center">
                                            {{$total}}
                                        </td>
                                    </tr>
                            </table>
                    </div>

                    <div class="flex flex-row-reverse py-3">
                        <x-jet-button wire:click="buyProducts" type="button">
                            Comprar
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center py-10">
            Actualmente, no dispones  de productos por comprar.
        </p>
    @endif

    @push('alerts')
        <script>
            Livewire.on('purchase-alert', (icon,title, text) => {
                Swal.fire({
                    icon,
                    title,
                    text,
                });
            });
            Livewire.on('bought', (icon,title, text) => {
                Swal.fire({
                    icon,
                    title,
                    text,
                    confirmButtonText : 'OK'
                }).then(result =>{
                    if (result.isConfirmed) {
                        livewire.emit('boughtDone')
                    }
                });
            })
        </script>
    @endpush
</div>
