@php
    $user = auth()->user();
@endphp
<x-app-layout>
    <section class="">
        <h1 class="text-center text-4xl font-bold py-20 bg-lime-500">
            Contáctanos
        </h1>
        <p class="leading-loose p-10">
            Permitenos conocer tus sugerencias e inquietudes frente a nuestros productos y/o servicios.
        </p>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="w-1/5 mx-auto bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                        <p class="font-bold">Mensaje enviado</p>
                    </div>
                </div>
            </div>
        @endif

        <x-jet-authentication-card>
            <x-slot name="logo">
                <i class="fa-solid fa-headset fa-3x"></i>
            </x-slot>
            <x-jet-validation-errors class="mb-4" />
            <form method="POST" action="{{ route('contact-us.store') }}" >
                @csrf
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="($user) ? $user->name : old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Phone') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="number" inputmode="numeric" name="phone" :value="($user) ? $user->phone : old('phone')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="($user) ? $user->email : old('email')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="message" value="{{ __('Mensaje') }}" />
                    <textarea id="message" name="message" required rows="10" class="block mt-1 w-full resize-none border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{old('message')}}</textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Enviar') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </section>
</x-app-layout>
