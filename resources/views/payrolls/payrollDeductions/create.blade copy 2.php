<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Nómina
            <!-- {{ __('Add New Contract') }} -->
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('payroll_deductions.store') }}">
                        @csrf
 
                        <div>
                            <x-label for="key" value="{{ __('Employee') }}" />
                            <select name="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select employee') }}</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{ $employee->name }} {{ $employee->last_name1 }}</option>
                                @endforeach
                            </select>
                        </div> <br>

                        <div>
                            <x-label for="key" value="{{ __('Deduction') }}" />
                            <select name="deduction_id" id="deduction_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select Deduction') }}</option>
                                @foreach ($deductions as $deduction)
                                    <option value="{{ $deduction->deduction_id }}">{{ $deduction->name }}</option>
                                @endforeach
                            </select>
                        </div> <br>

                        <div>
                            <x-label for="key" value="{{ __('Nómina') }}" />
                            <select name="payroll_id" id="payroll_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select Payroll') }}</option>
                                @foreach ($payrolls as $payroll)
                                    <option value="{{ $payroll->payroll_id }}">{{ $payroll->key }} - {{ $payroll->description }}</option>
                                @endforeach
                            </select>
                        </div> <br>

                        <div>
                            <x-label for="sum" value="{{ __('Sum') }}" />
                            <x-input id="sum" class="block mt-1 w-full" type="number" step="0.01" name="sum" :value="old('sum')" required autofocus autocomplete="sum" />
                        </div> <br>

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