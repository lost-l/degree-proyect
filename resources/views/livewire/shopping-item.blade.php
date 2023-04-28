<li class="flex flex-col py-6 sm:flex-row sm:justify-between">
    <div class="flex w-full space-x-2 sm:space-x-4">
        <img class="flex-shrink-0 object-cover w-20 h-20  rounded outline-none sm:w-32 sm:h-32 " src="{{$product['attributes']['image']}}" alt="{{$product['name']}}">
        <div class="flex flex-col justify-between w-full pb-4">
            <div class="flex justify-between w-full pb-2 space-x-2">
                <div class="space-y-1">
                    <h3 class="text-lg font-semibold leading-snug sm:pr-8">{{$product['name']}}</h3>
                    <p class="text-sm ">{{$product['attributes']['color']}}</p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-semibold">&#36; {{$product['price']}}</p>
                    {{$prodSum}}
                </div>
            </div>
            <div class="flex text-sm divide-x justify-around">
                <div class="flex items-center px-2 py-1 space-x-4">
                    <div>
                        <x-jet-secondary-button type="button" wire:click="decrementItem" class="py-3">
                            <i class="fa-solid fa-minus"></i>
                        </x-jet-secondary-button>
                        <x-jet-input id="quantity" class="inline-block text-center mt-1 w-1/4" type="number" readonly name="quantity" :value="$quantity" required />
                        <x-jet-secondary-button type="button" wire:click="incrementItem" class="py-3">
                            <i class="fa-solid fa-plus"></i>
                        </x-jet-secondary-button>
                    </div>
                </div>
                <button wire:click="removeProductItem" type="button" class="flex items-center px-2 py-1 pl-0 space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current">
                        <path d="M96,472a23.82,23.82,0,0,0,23.579,24H392.421A23.82,23.82,0,0,0,416,472V152H96Zm32-288H384V464H128Z"></path>
                        <rect width="32" height="200" x="168" y="216"></rect>
                        <rect width="32" height="200" x="240" y="216"></rect>
                        <rect width="32" height="200" x="312" y="216"></rect>
                        <path d="M328,88V40c0-13.458-9.488-24-21.6-24H205.6C193.488,16,184,26.542,184,40V88H64v32H448V88ZM216,48h80V88H216Z"></path>
                    </svg>
                    <span>Eliminar</span>
                </button>
            </div>
        </div>
    </div>
</li>
{{-- @dump($product) --}}
