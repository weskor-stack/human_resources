<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Add New Position') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('positions.store') }}">
                        @csrf
 
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <br>
                        </div>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="name" value="{{ __('Department') }}" />
                            <br>
                            <div id="secretary_1">
                                <x-label for="name" value="{{ __('Secretary') }}" />
                                <select name="secretary" id="secretary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="#" selected disabled>Choose a secretary</option>
                                    @foreach ($secretaries as $secretary)
                                        <option value="{{$secretary->secretary_id}}">{{ $secretary->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>

                            <div id="sub_secretary" hidden>
                                <x-label for="name" value="{{ __('Sub-Secretary') }}" />
                                <select name="undersecreatries" id="undersecreatries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                <br>
                            </div>

                            <div id="gestor" hidden>
                                <x-label for="name" value="{{ __('Management') }}" />
                                <select name="managements" id="managements" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                <br>
                            </div>

                            <div id="unidad" hidden>
                                <x-label for="name" value="{{ __('Unit') }}" />
                                <select name="units" id="units" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                <br>
                            </div>

                            <div id="departamento" hidden>
                                <x-label for="name" value="{{ __('Department') }}" />
                                <select name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                <br>
                            </div>

                        </div>

                        <div>
                            <x-label for="status_id" value="{{ __('Status') }}" />
                            <!-- x-input id="status_id" class="block mt-1 w-full" type="text" name="status_id" :value="old('status_id')" required autofocus autocomplete="status_id" / -->
                            <select id="status_id" name="status_id" :value="old('status_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose a status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{$status->status_id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>

                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <x-label for="location_id" value="{{ __('Location') }}" />
                            <br>
                            <div id="estados">
                                <x-label for="location_id" value="{{ __('State') }}" />
                                <select name="state" id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option selected disabled>Choose a state</option>
                                    @foreach ($federal_entity as $states)
                                        <option value="{{$states->federal_entity_id}}">{{$states->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            
                            <div id="municipios" hidden>
                                <x-label for="location_id" value="{{ __('Municipality') }}" />
                                <select name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                <br>
                            </div>

                            <div id="localidades" hidden>
                                <x-label for="location_id" value="{{ __('Location') }}" />
                                <select name="location_id" id="location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                            </div>
                            <!-- x-input id="status_id" class="block mt-1 w-full" type="text" name="status_id" :value="old('status_id')" required autofocus autocomplete="status_id" / -->
                            <!-- <select id="location_id" name="location_id" :value="old('location_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a location</option>
                                @foreach ($locations as $location)
                                    <option value="$location->location_id">{{$location->name}}</option>
                                @endforeach
                            </select> -->
                            <br>
                        </div>

                        <div>
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save Position') }}
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
        $('#secretary').on('change', function () {
            document.getElementById("sub_secretary").removeAttribute("hidden","");
            var countryId = $(this).val();
            //document.getElementById('customer_id').value= countryId;
            $('#undersecreatries').html('');
            $.ajax({
                url: "{{ route('getUndersecretary') }}?secretary_id="+countryId,
                type: 'get',
                success: function (res) {
                    $('#undersecreatries').html("<option value='0' disabled>{{ __('Select Sub secretary')}}</option>");
                    $.each(res, function (key, value) {
                        $('#undersecreatries').append('<option value="' + value
                            .undersecretary_id + '">' + value.name  +'</option>');
                    });
                }
            });
        });

        $('#undersecreatries').on('change', function () {
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
        $('#state').on('change', function () {
            document.getElementById("municipios").removeAttribute("hidden","");
            var contactId = this.value;
            //document.getElementById('contact_id').value= contactId;
            $('#municipality').html('');
            $.ajax({
                url: "{{ route('getMunicipality') }}?federal_entity_id="+contactId,
                type: 'get',
                success: function (res) {
                $('#municipality').html("<option value='0' selected disabled>{{ __('Select Municipality')}}</option>");
                $.each(res, function (key, value) {
                    $('#municipality').append('<option value="' + value
                        .municipality_id + '">' + value.name +'</option>');
                    });
                }
            });
            // document.getElementById("secretary_1").hidden = true;
            // document.getElementById("sub_secretary").hidden = true;
            // document.getElementById("gestor").hidden = true;
            // document.getElementById("unidad").hidden = true;
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
                $('#location_id').html("<option value='0' selected disabled>{{ __('Select Location')}}</option>");
                $.each(res, function (key, value) {
                    $('#location_id').append('<option value="' + value
                        .location_id + '">' + value.name +'</option>');
                    });
                }
            });
            // document.getElementById("secretary_1").hidden = true;
            // document.getElementById("sub_secretary").hidden = true;
            // document.getElementById("gestor").hidden = true;
            // document.getElementById("unidad").hidden = true;
        });
    });
</script>