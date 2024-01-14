<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Agregar Empleado') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('employees.store') }}">
                        @csrf
 
                        <div hidden>
                            <x-label for="key" value="{{ __('Key') }}" />
                            <x-input id="key" class="block mt-1 w-full" type="text" name="key" :value="old('key')" autofocus autocomplete="key" />
                        </div>

                        <div>
                            <x-label for="name" value="{{ __('Nombre') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="last_name1" value="{{ __('Apellido paterno') }}" />
                            <x-input id="last_name1" class="block mt-1 w-full" type="text" name="last_name1" :value="old('last_name1')" required autofocus autocomplete="last_name1" />
                        </div>
                        
                        <div>
                            <x-label for="last_name2" value="{{ __('Apellido materno') }}" />
                            <x-input id="last_name2" class="block mt-1 w-full" type="text" name="last_name2" :value="old('last_name2')" required autofocus autocomplete="last_name2" />
                        </div>

                        <div>
                            <x-label for="last_name2" value="{{ __('Observaciones') }}" />
                            <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-800 dark:focus:border-blue-800" placeholder="Observaciones"> </textarea>
                        </div>

                        <div hidden>
                            <x-label for="status_id" value="{{ __('Estado') }}" />
                            <!-- x-input id="status_id" class="block mt-1 w-full" type="text" name="status_id" :value="old('status_id')" required autofocus autocomplete="status_id" / -->
                            <select id="status_id" name="status_id" :value="old('status_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose a status</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>