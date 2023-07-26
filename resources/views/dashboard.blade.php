<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="background-image: url('http://localhost/human_resources/public/img/mosaicofondo-2.png')">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
