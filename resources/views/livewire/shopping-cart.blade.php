{{-- https://www.mambaui.com/components/shopping-cart --}}
<div>
    <button wire:click="$set('open', true)" class="sm:relative sm:top-1 sm:right-2 flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition p-2">
        <i class="fa-solid fa-cart-shopping fa-lg"></i>
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <h4 class="font-semibold">Carrito de compras</h4>
        </x-slot>
        <x-slot name="content">
            <ul class="flex flex-col divide-y divide-gray-700">
                @forelse ($products as $product)
                        <livewire:shopping-item :product="$product"  :wire:key="$product->id"/>
                @empty
                    <p class="text-center">
                        Aun no hay productos
                    </p>
                @endforelse
            </ul>
        </x-slot>
        <x-slot name="footer" >
            @if($products->count())
                <div>
                    <strong >Subtotal:</strong> &#36; <span>{{$subtotal}}</span>
                </div>
                <x-jet-danger-button wire:click="$emit('clean-cart')">Eliminar productos</x-jet-danger-button>
                <x-jet-button wire:click="purchase" class="text-center">Realizar compra</x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    @push('alerts')
        <script>
            Livewire.on('clean-cart', ()=>{
                Swal.fire({
                        title: '¿Seguro?',
                        text: "Limpiar el carrito",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borrar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('shopping-cart', 'cleanCart');
                        }
                })
            });

            Livewire.on('missing-alert', ()=>{
                Swal.fire({
                        title: 'Direccion',
                        text: "No tienes dirreciones aún",
                        icon: 'warning',
                        // showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('shopping-cart', 'profile');
                        }
                })
            });
            
        </script>
    @endpush
</div>
