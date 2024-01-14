<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar contrato') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('contract_jobs.update', $contractJob) }}">
                        @csrf
                        @method('PUT')
 
                        
                        <div>
                            <x-label for="name" value="{{ __('Empleado') }}" />
                            <x-input disabled id="name" class="block mt-1 w-full" type="text" name="name" value="{{$employees[0]->name}} {{$employees[0]->last_name1}} {{$employees[0]->last_name2}}" required autofocus autocomplete="name" />
                        </div>

                        <div hidden>
                            <x-input id="contract_id" class="block mt-1 w-full" type="text" name="contract_id" value="{{ round($contractJob->contract_id) }}" required autofocus autocomplete="contract_id" />
                        </div>

                        
                        <div>
                            <x-label for="user_id" value="{{ __('Contrato') }}" />
                            <x-input disabled id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $type_contract[0]->name }}" required autofocus autocomplete="user_id"/>
                        </div>

                        <div>
                            <x-label for="salary" value="{{ __('Salario') }}" />
                            <x-input id="salary" class="block mt-1 w-full" type="number" name="salary" value="{{ round($contractJob->salary) }}" required autofocus autocomplete="salary" step="0.01"/>

                        </div>
                        
                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Aceptar') }}
                            </x-button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>