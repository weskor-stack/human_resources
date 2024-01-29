<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Lista de contratos') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <br>
                    <a href="{{ route('contract_jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar +</a> <br><br>
                    
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-pink-900 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Contratos
                            </th>
                            <th scope="col" class="px-6 py-3" style="text-align:center;">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($contract_jobs as $contract_job)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    @foreach($contracts as $contract)
                                        @if ($contract->contract_id == $contract_job->contract_id)
                                            @foreach ($type_contracts as $type)
                                                @if ($type->type_contract_id == $contract->type_contract_id)
                                                    @foreach ($employees as $employee)
                                                        @if ($employee->employee_id == $contract->employee_id)
                                                            {{ __('Name') }}: {{ $employee->name }} {{ $employee->last_name1 }}{{ $employee->last_name2 }} /
                                                            {{ __('Contract tyoe') }}: {{ $type->name }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4" style="text-align:center;">
                                    <a href="{{ route('contract_jobs.edit', $contract_job) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                       <a href="{{ route('contract_jobs.show', $contract_job) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>

                                       <!--form method="POST" action="{{ route('contract_jobs.destroy', $contract_job) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button
                                                type="submit"
                                                onclick="return confirm('Are you sure?')">Delete</x-danger-button>
                                        </form-->
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ __('No hay contratos dadaos de alta') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {!! $contract_jobs->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>