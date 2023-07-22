<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Show Employee') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <div>
                        <strong>{{ __('Employee') }}:</strong>
                        @foreach ($employees as $employee)
                            @if($employee->employee_id == $personal_data->employee_id)
                                <x-label value="{{ $employee->name }} {{ $employee->last_name1 }} {{ $employee->last_name2 }}" />
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Date birth') }}:</strong>
                        <x-label value="{{ $personal_data->date_birth }}" />
                    </div>

                    <div>
                        <strong>{{ __('NSS') }}:</strong>
                        <x-label value="{{ $personal_data->nss }}" />
                    </div>

                    <div>
                        <strong>{{ __('RFC') }}:</strong>
                        <x-label value="{{ $personal_data->rfc }}" />
                    </div>

                    <div>
                        <strong>{{ __('CURP') }}:</strong>
                        <x-label value="{{ $personal_data->curp }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>