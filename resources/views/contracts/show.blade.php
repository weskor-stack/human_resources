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
                            @if($employee->employee_id == $contract->employee_id)
                                <x-label value="{{ $employee->name }} {{ $employee->last_name1 }} {{ $employee->last_name2 }}" />
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Position') }}:</strong>
                        @foreach ($positions as $position)
                            @if($position->position_id == $contract->position_id)
                                <x-label value="{{ $position->name }}" />
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Type contract') }}:</strong>
                        @foreach ($type_contracts as $contrato)
                            @if($contrato->type_contract_id == $contract->type_contract_id)
                                <x-label value="{{ $contrato->name }}" />
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Start date') }}:</strong>
                        <x-label value="{{ $contract->start_date }}" />
                    </div>

                    <div>
                        <strong>{{ __('End date') }}:</strong>
                        <x-label value="{{ $contract->end_date }}" />
                    </div>

                    <div>
                        <strong>{{ __('Status contract') }}:</strong>
                        @foreach ($status as $status)
                            @if($status->status_contract_id == $contract->status_contract_id)
                                <x-label value="{{ $status->name }}" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>