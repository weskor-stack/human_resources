<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Estados') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <br>
                    <a href="{{ route('statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar +</a> <br><br>
                    
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-pink-900 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Estados
                            </th>
                            <th scope="col" class="px-6 py-3" style="text-align:center;">
                                Acciones
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($status as $estado)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $estado->name }}
                                </td>
                                <td class="px-6 py-4" style="text-align:center;">
                                    <a href="{{ route('statuses.edit', $estado) }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                       <!--form method="POST" action="{{ route('statuses.destroy', $estado) }}" class="inline-block">
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
                                    {{ __('No se han registrado estados') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>