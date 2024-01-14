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

                        <div hidden>
                            <x-label for="status_id" value="{{ __('Estado') }}" />
                            <!-- x-input id="status_id" class="block mt-1 w-full" type="text" name="status_id" :value="old('status_id')" required autofocus autocomplete="status_id" / -->
                            <select id="status_id" name="status_id" :value="old('status_id')" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose a status</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>

                        <div>
                            <!-- <x-label for="user_id" value="{{ __('User') }}"/> -->
                            <x-input id="user_id" class="block mt-1 w-full" type="hidden" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <x-label for="name" value="{{ __('Nombre') }}:" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>
                            <div>
                                <x-label for="last_name1" value="{{ __('Apellido paterno') }}:" />
                                <x-input id="last_name1" class="block mt-1 w-full" type="text" name="last_name1" :value="old('last_name1')" required autofocus autocomplete="last_name1" />
                            </div>
                            <div>
                                <x-label for="last_name2" value="{{ __('Apellido materno') }}:" />
                                <x-input id="last_name2" class="block mt-1 w-full" type="text" name="last_name2" :value="old('last_name2')" required autofocus autocomplete="last_name2" />
                            </div>
                            <div>
                                <x-label for="last_name2" value="{{ __('Observaciones') }}:" />
                                <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-800 dark:focus:border-blue-800" placeholder="Observaciones"> </textarea>
                            </div>                            
                        </div>
                        <br>
                        <div>
                            <x-label value="Datos Personales:"/>
                        </div>
                        <br>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="relative max-w-sm">
                                <x-label for="date_birth" value="{{ __('Fecha de nacimiento') }}:" />
                                <!-- x-input id="date_birth" class="block mt-1 w-full" type="text" name="date_birth" :value="old('date_birth')" required autofocus autocomplete="date_birth" /-->
                                <!-- x-input datepicker type="text" id="date_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="date_birth" required placeholder="Select date"-->
                                @props(['options' => "{dateFormat:'Y-m-d', altFormat:'F j, Y', altInput:true, }"])
                                <div class="absolute inset-y-9 left-30 flex items-left pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <x-input id="date_birth" name="date_birth" x-data x-init="flatpickr($refs.input, {{ $options }} );" x-ref="input" type="text" data-input class='block mt-1 w-full pl-10 p-2.5'/>
                            </div>

                            <div>
                                <x-label for="nss" value="{{ __('NSS') }}:" />
                                <x-input id="nss" class="block mt-1 w-full" maxlength="10" type="text" name="nss" :value="old('nss')" autofocus autocomplete="nss" />
                            </div>
                            
                            <div>
                                <x-label for="rfc" value="{{ __('RFC') }}:" />
                                <x-input id="rfc" class="block mt-1 w-full" oninput="this.value = this.value.toUpperCase()" maxlength="15" type="text" name="rfc" :value="old('rfc')" required autofocus autocomplete="rfc" />
                            </div>

                            <div>
                                <x-label for="curp" value="{{ __('CURP') }}:" />
                                <x-input id="curp" class="block mt-1 w-full" oninput="this.value = this.value.toUpperCase()" maxlength="20" type="text" name="curp" :value="old('curp')" required autofocus autocomplete="curp" />
                            </div>

                            <div>
                                <x-label for="gender" value="{{ __('Genero') }}:" />
                                <br>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-1" type="radio" value="1" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-white dark:border-gray-600">
                                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-black-300">Masculino.</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-2" type="radio" value="2" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-white dark:border-gray-600">
                                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-black-300">Femenino.</label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input checked id="default-radio-3" type="radio" value="3" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-white dark:border-gray-600">
                                    <label for="default-radio-3" class="ms-2 text-sm font-medium text-gray-900 dark:text-black-300">Otro.</label>
                                </div>
                            </div>

                            <div>
                                <x-label for="level_schooling" value="{{ __('Nivel de estudios') }}:" />
                                <select id="level_schooling" name="level_schooling" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option selected disabled>Seleccionar nivel de estudios</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Bachillerato">Bachillerato o preparatoria</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="voter_identification" value="{{ __('Número de identificación') }}:" />
                                <x-input id="voter_identification" class="block mt-1 w-full" maxlength="20" type="text" name="voter_identification" :value="old('voter_identification')"  autofocus autocomplete="voter_identification" />
                            </div>

                            <div>
                                <x-label for="type_blood_id" value="{{ __('Tipo de sangre') }}:" />
                                <select id="type_blood_id" name="type_blood_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option selected disabled>Seleccionar tipo de sangre</option>
                                    @foreach($type_bloods as $blood)
                                        <option value="{{$blood->type_blood_id}}">{{$blood->key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <br>
                        <div>
                            <x-label value="Contacto:"/>
                        </div>
                        <br>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <x-label for="street" value="{{ __('Domicilio') }}:" />
                                <x-input required id="street" class="block mt-1 w-full" maxlength="45" type="text" name="street" :value="old('street')"  autofocus autocomplete="street" />
                            </div>

                            <div>
                                <x-label for="number" value="{{ __('Número') }}:" />
                                <x-input required id="number" class="block mt-1 w-full" maxlength="5" type="text" name="number" :value="old('number')"  autofocus autocomplete="number" />
                            </div>
                                
                            <div>
                                <x-label for="zip_code" value="{{ __('Código postal') }}:" />
                                <x-input required id="zip_code" class="block mt-1 w-full" maxlength="5" type="text" name="zip_code" :value="old('zip_code')"  autofocus autocomplete="zip_code" />
                            </div>
                            <div>
                                <x-label for="phone" value="{{ __('Teléfono') }}:" />
                                <x-input type="tel" id="phone" class="block mt-1 w-full" maxlength="15" name="phone" :value="old('phone')"  autofocus autocomplete="phone" placeholder="(123)-456-7890" onkeyup="handlePhone(event)" required />
                            </div>
                            <div class="mb-6">
                                <x-label for="email" value="{{ __('Correo electrónico') }}:" />
                                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@company.com" required>
                            </div> 
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div id="estados">
                                <x-label for="location_id" value="{{ __('Estados') }}:" />
                                <select name="state" id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option selected disabled>Seleccionar estado</option>
                                    @foreach ($federal_entity as $states)
                                        <option value="{{$states->federal_entity_id}}">{{$states->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="municipios" hidden>
                                <x-label for="location_id" value="{{ __('Municipio') }}:" />
                                <select name="municipality" id="municipality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required></select>
                                <br>
                            </div>

                            <div id="localidades" hidden>
                                <x-label for="location_id" value="{{ __('Localidad') }}:" />
                                <select name="location_id" id="location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required></select>
                            </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#state').on('change', function () {
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
<script>
    const handlePhone = (event) => {
        let input = event.target
        input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
        if (!value) return ""
        value = value.replace(/\D/g,'')
        value = value.replace(/(\d{3})(\d)/,"($1) $2")
        value = value.replace(/(\d)(\d{4})$/,"$1-$2")
        return value
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>