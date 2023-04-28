<div>
    <div class="mx-auto w-4/5 mt-10">
        <x-jet-input wire:model.lazy="search" id="search" class="block mt-1 w-full" type="search" placeholder="Buscar" name="search" :value="old('search')" required autofocus/>
        <div class="w-4/5 mx-auto flex flex-wrap justify-between sm:flex-row my-5">
            <div class="">
                <x-jet-label for="search" value="{{ __('Categoria') }}" />
                <select wire:model="category" name="category" id="category" class="py-0 rounded">
                    <option value=""></option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <x-jet-label for="price" value="{{ __('Precio') }}" />
                <select wire:model="price" name="price" id="price" class="py-0 rounded">
                    <option value=""></option>
                    @foreach ($prices as $price)
                        <option value="{{$price->price}}">{{$price->price}}</option>
                    @endforeach
                </select>
            </div>

            <div class="">
                <x-jet-label for="color" value="{{ __('Color') }}" />
                <select wire:model="color" name="color" id="color" class="py-0 rounded">
                    <option value=""></option>
                    @foreach ($colors as $color)
                        <option value="{{$color->color}}">{{$color->color}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div wire:loading class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl">
        <div class="p-6 border-l-4 border-green-500 -6 rounded-r-xl bg-green-50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <div class="text-sm text-green-600">
                        <p>Cargando...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.class="invisible" class="grid lg:grid-cols-2 lg:px-32 py-10 gap-y-4">
        @forelse ($products as $product)
            <x-product-item :product="$product" />
        @empty
            <p>
                Lo sentimos, actuamente no disponemos de productos que cumplan con dichos parametros.
            </p>
        @endforelse
    </div>
    @isset($products)
        <div wire:loading.class="invisible" class="flex justify-center pb-10">
            {{ $products->links() }}
        </div>
    @endisset
</div>
