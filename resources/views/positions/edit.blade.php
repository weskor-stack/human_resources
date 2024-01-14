<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Puesto') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('positions.update', $position) }}">
                        @csrf
                        @method('PUT')
 
                        <div>
                            <x-label for="name" value="{{ __('Nombre') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$position->name" required autofocus autocomplete="name" />
                            <br>
                        </div>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="name" value="{{ __('Departamento') }}" />
                            <br>
                            <div id="secretary_1">
                                <x-label for="name" value="{{ __('Secretaría') }}" />
                                <select name="secretary" id="secretary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$secretaries[0]->secretary_id}}" selected disabled>{{$secretaries[0]->name}}</option>
                                    @foreach ($secretary as $secretaria)
                                        <option value="{{$secretaria->secretary_id}}">{{ $secretaria->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>

                            <div id="sub_secretary">
                                <x-label for="name" value="{{ __('Sub-Secretaría') }}" />
                                <select name="undersecreatries" id="undersecreatries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$undersecreatries[0]->undersecretary_id}}&{{$undersecreatries[0]->secretary_id}}&{{$undersecreatries[0]->name}}" selected disabled>{{$undersecreatries[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="gestor">
                                <x-label for="name" value="{{ __('Gestor') }}" />
                                <select name="managements" id="managements" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$managements[0]->management_id}}&{{$managements[0]->undersecretary_id}}&{{$managements[0]->name}}" selected disabled>{{$managements[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="unidad">
                                <x-label for="name" value="{{ __('Unidad') }}" />
                                <select name="units" id="units" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$units[0]->unit_id}}&{{$units[0]->management_id}}&{{$units[0]->name}}" selected disabled>{{$units[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="departamento">
                                <x-label for="name" value="{{ __('Departamento') }}" />
                                <select name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$departments[0]->department_id}}&{{$departments[0]->unit_id}}&{{$departments[0]->name}}" selected >{{$departments[0]->name}}</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div>
                            <x-label for="status_id" value="{{ __('Estado') }}" />
                            <!-- x-input id="status_id" class="block mt-1 w-full" type="text" name="status_id" :value="old('status_id')" required autofocus autocomplete="status_id" / -->
                            <select id="status_id" name="status_id" :value="old('status_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{$statuses[0]->status_id}}" selected>{{$statuses[0]->name}}</option>
                                @foreach ($statuses_2 as $status)
                                    <option value="{{$status->status_id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>
                        
                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="location_id" value="{{ __('Location') }}" />
                            <br>
                            <div id="estados">
                                <x-label for="location_id" value="{{ __('Estados') }}" />
                                <select name="state" id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="{{$federal_entity[0]->status_id}}" selected disabled>{{$federal_entity[0]->name}}</option>
                                    @foreach ($federal_entity2 as $states)
                                        <option value="{{$states->federal_entity_id}}">{{$states->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>

                            <div id="municipios">
                                <x-label for="location_id" value="{{ __('Municipio') }}" />
                                <select name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$municipalities[0]->municipality_id}}&{{$municipalities[0]->federal_entity_id}}&{{$municipalities[0]->name}}" selected disabled>{{$municipalities[0]->name}}</option>
                                </select>
                                <br>
                            </div>

                            <div id="localidades" >
                                <x-label for="location_id" value="{{ __('Localidad') }}" />
                                <select name="location_id" id="location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{$locations[0]->location_id}}&{{$locations[0]->municipality_id}}&{{$locations[0]->name}}" selected>{{$locations[0]->name}}</option>
                                </select>
                            </div>
                           
                        </div>

                        <br>
                        <div>
                            <x-label for="address" value="{{ __('Dirección') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$position->address" required autofocus autocomplete="address" />
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="$position->user_id" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var sub_secretary = document.getElementById("undersecreatries").value;
        var management = document.getElementById("managements").value;
        var units = document.getElementById("units").value;
        var department = document.getElementById("department_id").value;
        var municipio = document.getElementById("municipality").value;
        var location = document.getElementById("location_id").value;
        sub_secretary = sub_secretary.split('&');
        management = management.split('&');
        units = units.split('&');
        department = department.split('&');
        municipio = municipio.split('&');
        location = location.split('&');
        
        // alert(department);
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
            url: "{{ route('getMunicipality') }}?federal_entity_id="+municipio[1],
            type: 'get',
            success: function (res) {
            $('#municipality').html("<option value='"+municipio[0]+"' selected>"+municipio[2]+"</option>");
            $.each(res, function (key, value) {
                $('#municipality').append('<option value="' + value
                    .municipality_id + '">' + value.name +'</option>');
                });
            }
        });

        $.ajax({
            url: "{{ route('getLocation') }}?municipality_id="+location[1],
            type: 'get',
            success: function (res) {
            $('#location_id').html("<option value='"+location[0]+"' selected>"+location[2]+"</option>");
            $.each(res, function (key, value) {
                $('#location_id').append('<option value="' + value
                    .location_id + '">' + value.name +'</option>');
                });
            }
        });

        $('#secretary').on('change', function () {
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
                    $('#undersecreatries').html("<option value='0' selected disabled>{{ __('Seleccionar Sub secretaría')}}</option>");
                    $.each(res, function (key, value) {
                        $('#undersecreatries').append('<option value="' + value
                            .undersecretary_id + '">' + value.name  +'</option>');
                    });
                }
            });
        });
        $('#undersecreatries').on('change', function () {
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
                $('#managements').html("<option value='0' selected disabled>{{ __('Seleccionar Gestor')}}</option>");
                $.each(res, function (key, value) {
                    $('#managements').append('<option value="' + value
                        .management_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#managements').on('change', function () {
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
                $('#units').html("<option value='0' selected disabled>{{ __('Seleccionar Unidad')}}</option>");
                $.each(res, function (key, value) {
                    $('#units').append('<option value="' + value
                        .unit_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#units').on('change', function () {
            document.getElementById("departamento").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#department_id').html('');
            $.ajax({
                url: "{{ route('getDepartments') }}?unit_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#department_id').html("<option value='0' selected disabled>{{ __('Seleccionar Departamento')}}</option>");
                $.each(res, function (key, value) {
                    $('#department_id').append('<option value="' + value
                        .department_id + '">' + value.name +'</option>');
                    });
                }
            });
        });
        $('#state').on('change', function () {
            document.getElementById("municipios").hidden = true;
            document.getElementById("localidades").hidden = true;
            document.getElementById("municipios").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#municipality').html('');
            $.ajax({
                url: "{{ route('getMunicipality') }}?federal_entity_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#municipality').html("<option value='0' selected disabled>{{ __('Seleccionar Municipio')}}</option>");
                $.each(res, function (key, value) {
                    $('#municipality').append('<option value="' + value
                        .municipality_id + '">' + value.name +'</option>');
                    });
                }
            });
        });

        $('#municipality').on('change', function () {
            document.getElementById("localidades").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#location_id').html('');
            $.ajax({
                url: "{{ route('getLocation') }}?municipality_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#location_id').html("<option value='0' selected disabled>{{ __('Seleccionar Localidad')}}</option>");
                $.each(res, function (key, value) {
                    $('#location_id').append('<option value="' + value
                        .location_id + '">' + value.name +'</option>');
                    });
                }
            });
        });
    });
</script>