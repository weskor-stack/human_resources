<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Add New Data') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('personal_datas.store') }}">
                        @csrf
 
                        <div>
                        <x-label for="employee_id" value="{{ __('Employee') }}" />
                            <select id="employee_id" name="employee_id" :value="old('employee_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose an employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->employee_id}}">{{ $employee->name }} {{ $employee->last_name1 }} {{ $employee->last_name2 }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative max-w-sm">
                            <x-label for="date_birth" value="{{ __('Date birth') }}" />
                            <!-- x-input id="date_birth" class="block mt-1 w-full" type="text" name="date_birth" :value="old('date_birth')" required autofocus autocomplete="date_birth" /-->
                            <!-- x-input datepicker type="text" id="date_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="date_birth" required placeholder="Select date"-->
                            @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                            <div class="absolute inset-y-9 left-30 flex items-left pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <x-input id="date_birth" name="date_birth" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5'/>
                        </div>

                        <div>
                            <x-label for="nss" value="{{ __('NSS') }}" />
                            <x-input id="nss" class="block mt-1 w-full" type="text" name="nss" :value="old('nss')" required autofocus autocomplete="nss" />
                        </div>
                        
                        <div>
                            <x-label for="rfc" value="{{ __('RFC') }}" />
                            <x-input id="rfc" class="block mt-1 w-full" type="text" name="rfc" :value="old('rfc')" required autofocus autocomplete="rfc" />
                        </div>

                        <div>
                            <x-label for="curp" value="{{ __('CURP') }}" />
                            <x-input id="curp" class="block mt-1 w-full" type="text" name="curp" :value="old('curp')" required autofocus autocomplete="curp" />
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save Employee') }}
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