<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Add New Contract Job') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('contract_jobs.store') }}">
                        @csrf
 
                        <div>
                            <x-label for="employee" value="{{ __('Employee') }}" />
                            <select name="employee" id="employee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#"> {{ __('Select employee') }} </option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}"> {{ $employee->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <br>

                        <div id="field" hidden>
                            <x-label for="contract_id" value="{{ __('Contract') }}" />
                            <div hidden>
                                <x-input id="contract_id" class="block mt-1 w-full" type="text" name="contract_id" :value="old('contract_id')" required autofocus autocomplete="contract_id" />
                            </div>
                            <x-input disabled id="contract" class="block mt-1 w-full" type="text" name="contract" :value="old('contract')" required autofocus autocomplete="contract" />
                            <!-- <select name="contract_id" id="contract_id"></select> -->
                        </div>

                        <br>

                        <div>
                            <x-label for="salary" value="{{ __('Salary') }}" />
                            <x-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary')" step="0.01" required autofocus autocomplete="salary" />
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save contract job') }}
                            </x-button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#employee').on('change', function () {
            document.getElementById("field").removeAttribute("hidden","");
            var countryId = $(this).val();
            // document.getElementById('contract_id').value= countryId;
            // $('#undersecreatries').html('');
            $.ajax({
                url: "{{ route('getContracts') }}?employee_id="+countryId,
                type: 'get',
                success: function (res) {
                    $.each(res, function (key, value2) {
                        document.getElementById('contract_id').value= value2.contract_id;
                        // $('#contract_id').append('<option value="' + value
                        //     .contract_id + '">' + value.contract_id  +'</option>');
                    });
                }
            });
            $.ajax({
                url: "{{ route('getTypeContracts') }}?employee_id="+countryId,
                type: 'get',
                success: function (res) {
                    $.each(res, function (key, value2) {
                        document.getElementById('contract').value= value2.name;
                        // $('#contract_id').append('<option value="' + value
                        //     .contract_id + '">' + value.contract_id  +'</option>');
                    });
                }
            });
        });
    });
</script>