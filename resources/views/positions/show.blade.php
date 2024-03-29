<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Puesto') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <div>
                        <strong>{{ __('Nombre') }}:</strong>
                        {{$position->name}}
                    </div>

                    <div>
                        <strong>{{ __('Departamento') }}:</strong>
                            @foreach ($departments as $department)
                                @if($department->department_id == $position->department_id)
                                    {{ $department->name }}
                                @endif
                            @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Estado') }}:</strong>
                        @foreach ($statuses as $status)
                            @if($status->status_id == $position->status_id)
                                {{ $status->name }}
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Localidad') }}:</strong>
                        @foreach ($locations as $location)
                            @if($location->location_id == $position->location_id)
                                {{ $location->name }}
                            @endif
                        @endforeach
                    </div>

                    <div>
                        <strong>{{ __('Dirección') }}:</strong>
                        {{$position->address}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>