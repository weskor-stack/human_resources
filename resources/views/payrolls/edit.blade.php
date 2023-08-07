<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Contract') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('payrolls.update', $payroll->payroll_id) }}">
                        @csrf
                        @method('PUT')
 
                        
                        <div>
                            <x-label for="key" value="{{ __('Key') }}" />
                            <x-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" required autofocus autocomplete="key" value="{{ $payroll->key }}"/>
                        </div>

                        <br>

                        <div>
                            <x-label for="description" value="{{ __('Description') }}" />
                            <textarea name="description" id="description" cols="30" rows="5" class="block mt-1 w-full">{{ $payroll->description }}</textarea>
                        </div>
                        <br>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="position_id" value="{{ __('Data') }}" />
                            <table style="text-align:center" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <tr>
                                    <td>{{ __('Income') }}</td>
                                    <td>{{ __('Output') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                                        <div class="absolute inset-y-55 left-30 flex items-left pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-12 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <x-input id="start_date" name="start_date" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5' value="{{ $payroll->start_date }}"/>
                                    </td>
                                    <td>
                                    @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                                        <div class="absolute inset-y-50 left-30 flex items-left pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-12 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <x-input id="end_date" name="end_date" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5' value="{{ $payroll->end_date }}"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>


                        <div>
                            <x-label for="name" value="{{ __('Month') }}"/>
                            <select name="month_id" id="month_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{ $month[0]->month_id }}" selected>{{ $month[0]->name }}</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month->month_id }}">{{ $month->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save') }}
                            </x-button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>