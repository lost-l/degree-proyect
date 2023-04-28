@php
    $path = asset('storage/images/about.jpg') ;
@endphp
<x-app-layout>
    <section class="py-32 bg-lime-500 bg-no-repeat bg-right bg-cover sm:bg-fixed " style="background-image: url({{$path}})">
        <p class="relative top-8 sm:-top-10 left-3 sm:static sm:pl-20 text-2xl font-semibold inline-block bg-gray-400 opacity-75  p-3 sm:bg-none">
            Variedad en lenceria para tu hogar.
            <br>
            Somos fabricantes.
        </p>
    </section>
    <section class="h-1/3">
        <div class="flex-col flex-wrap sm:flex sm:flex-row  sm:justify-around sm:pr-7 py-10">
            @forelse ($products as $product)
                <x-product-item :product="$product" />
            @empty
                <p>
                    lo sentimos, actualmente no disponemos de productos.
                </p>
            @endforelse
        </div>
    </section>
    <section class=" h-1/3">
        <h2 class="text-center capitalize text-2xl py-5 font-bold bg-slate-600 text-white">Conoce nuestras categorías</h2>
        <div class="flex flex-col items-center space-y-8 sm:space-y-0 sm:flex-row sm:flex-wrap sm:justify-around bg-slate-400 py-16">
            @forelse ($categories as $category)
            <a href="{{route('products', ['category' => $category->id])}}" type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">{{$category->name}}</a>
            @empty
                <p>Actualmente, no disponemos de categorías</p>
            @endforelse
        </div>
    </section>
</x-app-layout>
