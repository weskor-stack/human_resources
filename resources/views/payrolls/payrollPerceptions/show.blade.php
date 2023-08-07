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
                        <strong>{{ __('Employee') }}:</strong>
                        <x-label value="{{ $employees->name }} {{ $employees->last_name1 }}" />
                    </div>

                    <div>
                        <strong>{{ __('Perception') }}:</strong>
                        <x-label value="{{ $perceptions->name }}" />
                    </div>

                    <div>
                        <strong>{{ __('Nómina') }}:</strong>
                        <x-label value="{{ $payrolls->description }}" />
                    </div>

                    <div>
                        <strong>{{ __('sum') }}:</strong>
                        <x-label value="{{ $payroll_perception->sum }}" />
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>