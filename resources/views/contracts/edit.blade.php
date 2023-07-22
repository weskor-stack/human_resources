<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Contract') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('contracts.update', $contract) }}">
                        @csrf
                        @method('PUT')
 
                        
                        <div>
                            <x-label for="name" value="{{ __('Employee') }}" />
                            <select name="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{ $contract->employee_id }}" selected>{{ $employee_data[0]->name }} {{ $employee_data[0]->last_name1 }} {{ $employee_data[0]->last_name2 }}</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{$employee->name}} {{$employee->last_name1}} {{ $employee->last_name2 }}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="name" value="{{ __('Position') }}" />
                            <div>
                                <x-label for="name" value="{{ __('Secretary') }}" />
                                <select name="secretary" id="secretary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$secretary[0]->secretary_id}}" selected disabled>{{ $secretary[0]->name }}</option>
                                    @foreach ($secretaries as $secretary)
                                        <option value="{{$secretary->secretary_id}}-{{ $secretary->status_id }}">{{ $secretary->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div id="sub_secretary">
                                <x-label for="name" value="{{ __('Sub-Secretary') }}" />
                                <select name="undersecreatries" id="undersecreatries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$undersecretary[0]->undersecretary_id}}-{{$undersecretary[0]->secretary_id}}-{{$undersecretary[0]->name}}" selected disabled>{{$undersecretary[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="gestor">
                                <x-label for="name" value="{{ __('Management') }}" />
                                <select name="managements" id="managements" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$management[0]->management_id}}-{{$management[0]->undersecretary_id}}-{{$management[0]->name}}" selected disabled>{{$management[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="unidad">
                                <x-label for="name" value="{{ __('Unit') }}" />
                                <select name="units" id="units" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$unit[0]->unit_id}}-{{$unit[0]->management_id}}-{{$unit[0]->name}}" selected disabled>{{$unit[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="departamento">
                                <x-label for="name" value="{{ __('Department') }}" />
                                <select name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$department[0]->department_id}}-{{$department[0]->unit_id}}-{{$department[0]->name}}" selected >{{$department[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="puesto" >
                                <x-label for="position_id" value="{{ __('Position') }}" />
                                <select name="position_id" id="position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{ $position[0]->position_id }}-{{ $position[0]->department_id }}-{{ $position[0]->name }}">{{ $position[0]->name }}</option>
                                </select>
                                <br>
                            </div>
                        </div>
                        <br>

                        <div>
                            <x-label for="position_id" value="{{ __('Type contract') }}" />
                            <select name="type_contract_id" id="type_contract_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{$type_contract[0]->type_contract_id}}" selected>{{ $type_contract[0]->name }}</option>
                                @foreach ($type_contracts as $type)
                                    <option value="{{ $type->type_contract_id }}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="position_id" value="{{ __('Data') }}" />
                            <table style="text-align:center" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <tr>
                                    <td>{{ __('Income') }}</td>
                                    <td>{{ __('Output') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                                        <div class="absolute inset-y-55 left-30 flex items-left pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-12 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <x-input id="start_date" name="start_date" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5' value="{{ $contract->start_date }}"/>
                                    </td>
                                    <td>
                                    @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                                        <div class="absolute inset-y-50 left-30 flex items-left pl-3.5 pointer-events-none">
                                            <svg class="w-4 h-12 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                            </svg>
                                        </div>
                                        <x-input id="end_date" name="end_date" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5' value="{{ $contract->end_date }}"/>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>

                        <div>
                            <x-label for="name" value="{{ __('Checador') }}" />
                            <input checked id="check_attendance" name="check_attendance" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <br>
                        </div>

                        <br>

                        <div>
                            <x-label for="name" value="{{ __('Status') }}"/>
                            <select name="status_contract_id" id="status_contract_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{ $status_contracts[0]->status_contract_id }}" selected>{{ $status_contracts[0]->name }}</option>
                                @foreach ($status as $status)
                                    <option value="{{ $status->status_contract_id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save Contract') }}
                            </x-button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var secretary = document.getElementById("secretary").value;
        var sub_secretary = document.getElementById("undersecreatries").value;
        var management = document.getElementById("managements").value;
        var units = document.getElementById("units").value;
        var department = document.getElementById("department_id").value;
        var position = document.getElementById("position_id").value;
        sub_secretary = sub_secretary.split('-');
        management = management.split('-');
        units = units.split('-');
        department = department.split('-');
        position = position.split('-');
        
        // alert(position[1]);
        // $('#undersecreatries').html('');
        $.ajax({
            url: "{{ route('getUndersecretary') }}?secretary_id="+sub_secretary[1],
            type: 'get',
            success: function (res) {
                $('#undersecreatries').html("<option value='"+sub_secretary[0]+"' selected>"+sub_secretary[2]+"</option>");
                $.each(res, function (key, value) {
                    $('#undersecreatries').append('<option value="' + value
                        .undersecretary_id + '">' + value.name  +'</option>');
                });
            }
        });

        $.ajax({
            url: "{{ route('getManagements') }}?undersecretary_id="+management[1],
            type: 'get',
            success: function (res) {
            $('#managements').html("<option value='"+management[0]+"' selected>"+management[2]+"</option>");
            $.each(res, function (key, value) {
                $('#managements').append('<option value="' + value
                    .management_id + '">' + value.name +'</option>');
                });
            }
        });

        $.ajax({
            url: "{{ route('getUnits') }}?management_id="+units[1],
            type: 'get',
            success: function (res) {
            $('#units').html("<option value='"+units[0]+"' selected disabled>"+units[2]+"</option>");
            $.each(res, function (key, value) {
                $('#units').append('<option value="' + value
                    .unit_id + '">' + value.name +'</option>');
                });
            }
        });

        $.ajax({
            url: "{{ route('getDepartments') }}?unit_id="+department[1],
            type: 'get',
            success: function (res) {
            $('#department_id').html("<option value='"+department[0]+"' selected>"+department[2]+"</option>");
            $.each(res, function (key, value) {
                $('#department_id').append('<option value="' + value
                    .department_id + '">' + value.name +'</option>');
                });
            }
        });

        $.ajax({
                url: "{{ route('getPositions') }}?department_id="+position[1],
                type: 'get',
                success: function (res) {
                $('#position_id').html("<option value='"+position[0]+"' selected >"+position[2]+"</option>");
                $.each(res, function (key, value) {
                    $('#position_id').append('<option value="' + value
                        .position_id + '">' + value.name +'</option>');
                    });
                }
            });

        $('#secretary').on('change', function () {
            document.getElementById("puesto").hidden = true;
            document.getElementById("departamento").hidden = true;
            document.getElementById("sub_secretary").hidden = true;
            document.getElementById("gestor").hidden = true;
            document.getElementById("unidad").hidden = true;
            document.getElementById("sub_secretary").removeAttribute("hidden","");
            var countryId = $(this).val();
            //document.getElementById('customer_id').value= countryId;
            $('#undersecreatries').html('');
            $.ajax({
                url: "{{ route('getUndersecretary') }}?secretary_id="+countryId,
                type: 'get',
                success: function (res) {
                    $('#undersecreatries').html("<option value='0' selected disabled>{{ __('Select Sub secretary')}}</option>");
                    $.each(res, function (key, value) {
                        $('#undersecreatries').append('<option value="' + value
                            .undersecretary_id + '">' + value.name  +'</option>');
                    });
                }
            });
        });
        $('#undersecreatries').on('change', function () {
            document.getElementById("puesto").hidden = true;
            document.getElementById("departamento").hidden = true;
            document.getElementById("gestor").hidden = true;
            document.getElementById("unidad").hidden = true;
            document.getElementById("gestor").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#managements').html('');
            $.ajax({
                url: "{{ route('getManagements') }}?undersecretary_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#managements').html("<option value='0' selected disabled>{{ __('Select Management')}}</option>");
                $.each(res, function (key, value) {
                    $('#managements').append('<option value="' + value
                        .management_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#managements').on('change', function () {
            document.getElementById("puesto").hidden = true;
            document.getElementById("departamento").hidden = true;
            document.getElementById("unidad").hidden = true;
            document.getElementById("unidad").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#units').html('');
            $.ajax({
                url: "{{ route('getUnits') }}?management_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#units').html("<option value='0' selected disabled>{{ __('Select Unit')}}</option>");
                $.each(res, function (key, value) {
                    $('#units').append('<option value="' + value
                        .unit_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#units').on('change', function () {
            document.getElementById("puesto").hidden = true;
            document.getElementById("departamento").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#department_id').html('');
            $.ajax({
                url: "{{ route('getDepartments') }}?unit_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#department_id').html("<option value='0' selected disabled>{{ __('Select Department')}}</option>");
                $.each(res, function (key, value) {
                    $('#department_id').append('<option value="' + value
                        .department_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#department_id').on('change', function () {
            document.getElementById("puesto").hidden = true;
            document.getElementById("puesto").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#position_id').html('');
            $.ajax({
                url: "{{ route('getPositions') }}?department_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#position_id').html("<option value='0' selected disabled>{{ __('Select Position')}}</option>");
                $.each(res, function (key, value) {
                    $('#position_id').append('<option value="' + value
                        .position_id + '">' + value.name +'</option>');
                    });
                }
            });
        });
        
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>