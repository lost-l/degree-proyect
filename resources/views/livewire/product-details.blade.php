<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col space-y-5 md:flex-row md:space-x-4 md:space-y-0">
            <div class="">
                <img src="{{$product->image}}" alt="{{$product->name}}">
            </div>
            <div class="py-10 px-4 flex flex-col space-y-5 justify-between">
                <h3 class="text-center font-bold">{{$product->name}}</h3>
                <ul class="py-2">
                    <li><strong>Precio:</strong> {{$product->price}}</li>
                    <li><strong>Color:</strong> {{$product->color}}</li>
                    <li><strong>Stock:</strong> {{$product->stock}}</li>
                </ul>
                <p>
                    {{$product->description}}
                </p>
                <div class="pl-3 sm:pl-0 flex justify-around items-center">
                    @if ($product->stock)
                        <div>
                            <x-jet-secondary-button type="button" wire:click="decrement" class="py-3">
                                <i class="fa-solid fa-minus"></i>
                            </x-jet-secondary-button>
                            {{-- <input type="number" value="{{$quantity}}"> --}}
                            <x-jet-input id="quantity" class="inline-block text-center mt-1 w-1/4" type="number" readonly name="quantity" :value="old('quantity', $quantity)" required />
                            <x-jet-secondary-button type="button" wire:click="increment" class="py-3">
                                <i class="fa-solid fa-plus"></i>
                            </x-jet-secondary-button>
                        </div>
                        {{-- @auth --}}
                            @unless (Auth::user()?->hasRole('delivery'))
                            <x-jet-button wire:click="addItemCart" type="button">
                                {{__('Add to cart')}}
                            </x-jet-button>
                            @endunless
                        {{-- @endauth --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('alerts')
        <script>
            Livewire.on('alert-product', (title, icon = 'success') => {
                Swal.fire({
                    title,
                    icon
                })
            })
        </script>
    @endpush
</div>
