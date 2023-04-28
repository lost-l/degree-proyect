@php
    $path = asset('storage/images/section_ii.jpg');
@endphp

<x-app-layout>
    <h1 class="bg-lime-500 bg-no-repeat bg-cover  bg-center bg-fixed py-20 text-center text-4xl font-bold" style="background-image: url({{$path}})">
        Conócenos
    </h1>
    <p class="p-10 leading-loose">
        Somos una pequeña empresa radicada en la ciudad de Bogotá, nos dedicamos a la fabricación de de limpiones y/o bayetillas, toallas asi como tambien de cobijas. Nos caracterizamos por ser una empresa versatil en cuanto sus diseños.
    </p>
</x-app-layout>
