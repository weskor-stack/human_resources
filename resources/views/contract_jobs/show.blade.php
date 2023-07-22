<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Show Position') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <div>
                        <strong>{{ __('Employee') }}:</strong>
                        {{$employees[0]->name}} {{$employees[0]->last_name1}} {{$employees[0]->last_name2}}
                    </div>

                    <div>
                        <strong>{{ __('Contract type') }}:</strong>
                            {{ $type_contract[0]->name }}
                    </div>

                    <div>
                        <strong>{{ __('Salary') }}:</strong>
                        {{ round($contractJob->salary) }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>