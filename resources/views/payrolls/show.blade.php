<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Nómina') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <div>
                        <strong>{{ __('Key') }}:</strong>
                        <x-label value="{{ $payroll->key }}" />
                    </div>

                    <div>
                        <strong>{{ __('Descripción') }}:</strong>
                        <x-label value="{{ $payroll->description }}" />
                    </div>

                    <div>
                        <strong>{{ __('Start date') }}:</strong>
                        <x-label value="{{ $payroll->start_date }}" />
                    </div>

                    <div>
                        <strong>{{ __('End date') }}:</strong>
                        <x-label value="{{ $payroll->end_date }}" />
                    </div>

                    <div>
                        <strong>{{ __('Mes') }}:</strong>
                        @foreach ($months as $mes)
                            @if ($mes->month_id == $payroll->month_id)
                                <x-label value="{{ $mes->name }}" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>