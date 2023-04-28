<div class="flex flex-col items-center">
    <div class="sm:mx-4 rounded-lg shadow-lg bg-white max-w-sm mt-5">
        <img class="rounded-t-lg" src="{{$product->image}}" alt="{{$product->slug}}">
        <div class="p-4">
            <h5 class="text-gray-900 text-xl font-bold mb-2">{{$product->name}}</h5>
            <p class="text-gray-700 text-base mb-4">
                <strong>Precio:</strong> &#36; {{$product->price}}
            </p>
            <div class="flex flex-row-reverse">
                <a type="button" href="{{route('product-details', ['product' => $product])}}" class="cursor-pointer inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Más detalles</a>
            </div>
        </div>
    </div>
</div>
