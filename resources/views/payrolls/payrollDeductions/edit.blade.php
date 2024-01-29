<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Nómina') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('payroll_deductions.update', $payroll_deduction) }}">
                        @csrf
                        @method('PUT')
 
                        <div>
                            <x-label for="key" value="{{ __('Empleado') }}" />
                            <select name="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{ $p_employees[0]->employee_id }}" selected>{{ $p_employees[0]->name }} {{ $p_employees[0]->last_name1 }}</option>
                                <!-- @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{ $employee->name }} {{ $employee->last_name1 }}</option>
                                @endforeach -->
                            </select>
                        </div> <br>
                        
                        <div id="mod">
                            <x-label for="key" value="{{ __('Modalidad') }}" />
                            <table style="width: 100%;">
                                <tr style="widt: 50%">
                                    <td width="50%">
                                        <select name="modalidad" id="modalidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                    </td>
                                    <td style="text-align: center;">
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-primary">
                                                <input type="checkbox" id="mes"> Mensual
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div> <br>

                        <div id="position">
                            
                            <table style="width: 100%;">
                                <tr style="widt: 50%">
                                    <td width="50%">
                                        <x-label for="key" value="{{ __('Puesto') }}" />
                                        <select name="contrato" id="contrato" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                    </td>
                                    <td style="text-align: center;">
                                        <x-label for="key" value="{{ __('Ubicación') }}" />
                                        <select name="ubicacion" id="ubicacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br>

                        <div id="nomina">
                            <x-label for="key" value="{{ __('Nómina') }}" />
                            <select name="payroll_id" id="payroll_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="{{$p_payrolls[0]->payroll_id}}" selected>{{ $p_payrolls[0]->key }} - {{ $p_payrolls[0]->description }}</option>
                                @foreach ($payrolls as $payroll)
                                    <option value="{{ $payroll->payroll_id }}">{{ $payroll->key }} - {{ $payroll->description }}</option>
                                @endforeach
                            </select>
                            <!-- <x-label for="key" value="{{ __('Nómina') }}" />
                            <select name="payroll_id" id="payroll_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select Payroll') }}</option>
                                @foreach ($payrolls as $payroll)
                                    <option value="{{ $payroll->payroll_id }}">{{ $payroll->key }} - {{ $payroll->description }}</option>
                                @endforeach
                            </select> -->
                        </div> <br>

                        <div id="reload">

                            <table>
                                <tr>
                                    <x-label value="{{ __('Percepciones:') }}" style="font-weight: bold; display: block;"/>
                                    <br>
                                </tr>
                                <tr id="suma_percepcion"></tr>
                                <tr id="suma_percepcion2"></tr>
                                <tr id="datos_percepcion"></tr>
                            </table>

                        </div>

                        <br>
                        
                        <div id="deduction_id">
                            <table>
                                <tr>
                                    <x-label value="{{ __('Deducciones:') }}" style="font-weight: bold; display: block;"/>
                                    <br>
                                </tr>
                                <tr id="deduccion"></tr>
                                <tr id="deduction"></tr>
                                <tr id="deduction_data"></tr>
                                <tr id="totales"></tr>
                            </table>
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                        </div>
 
                        <div id="save">
                            <div class="flex mt-4">
                                <x-button
                                    onclick="return confirm('¿Estas de acuerdo en guarar la información?')">{{ __('Aceptar') }}
                                </x-button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        checkBox = document.getElementById('mes');
        var countryId = $('#employee_id').val();
        var salario = 1;
        var tabulador_inicial = 0;
        var porcentaje = 0;
        var tabulador_anterior = 0;
        var isr = 0;
        var total = 0;
        var suma = 0;
        var resta = 0;
        var other_deduction = 0;
        var other_perception = 0;
        
        $.ajax({
            url: "{{ route('getSalaries') }}?employee_id="+countryId,
            type: 'get',
            success: function (res2) {
                $.each(res2, function (key2, value2) {
                    salario = parseFloat(value2.salary);
                    salario = salario;                        
                });
            }
        });

        $.ajax({
            url: "{{ route('getTaxes') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $.each(res, function (key, value) {
                    tabulador_inicial = parseFloat(value.lower);
                    porcentaje = parseFloat(value.percentage)/100;
                    porcentaje = porcentaje.toFixed(4);
                });
            }
        });

        $.ajax({
            url: "{{ route('getTaxes2') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $.each(res, function (key, value) {
                    tabulador_anterior = parseFloat(value.fee);
                    
                });
            }
        });

        // $.ajax({
        //     url: "{{ route('getDeductions_employee') }}?employee_id="+countryId,
        //     type: 'get',
        //     success: function (res2) {
        //         $.each(res2, function (key2, value2) {
        //             if(value.deduction_id == value2.deduction_id){
        //                 alert(value2.sum)
        //                 other_deduction = parseFloat(value2.sum);
        //             }
        //         });
        //     }
        // });

        $.ajax({
            url: "{{ route('getPayrolls') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $('#contrato').html("<option value='0' disabled>{{ __('Seleccionar nómina')}}</option>");
                $.each(res, function (key, value) {
                    $('#contrato').append('<option value="' + value
                        .position_id + '">' + value.name  +'</option>');
                });
            }
        });
        $.ajax({
            url: "{{ route('getTypeContracts') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $('#modalidad').html("<option value='0' disabled>{{ __('Seleccionar tipo de contrato')}}</option>");
                $.each(res, function (key, value) {
                    $('#modalidad').append('<option value="' + value
                        .type_contract_id + '">' + value.name  +'</option>');
                });
            }
        });
        $.ajax({
            url: "{{ route('getLocationpayrolls') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $('#ubicacion').html("<option value='0' disabled>{{ __('Seleccionar localización')}}</option>");
                $.each(res, function (key, value) {
                    $('#ubicacion').append('<option value="' + value
                        .location_id + '">' + value.name  +'</option>');
                });
            }
        });
        // $.ajax({
        //     url: "{{ route('getPayrollDeductions') }}?employee_id="+countryId,
        //     type: 'get',
        //     success: function (res) {
        //         $('#payroll_id').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
        //         $.each(res, function (key, value) {
        //             $('#payroll_id').append('<option value="' + value
        //                 .payroll_id + '">' + value.key  +' - '+value.description+'</option>');
        //         });
        //     }
        // });
        $.ajax({
            url: "{{ route('getPerceptions') }}?employee_id="+countryId,
            type: 'get',
            success: function (res) {
                $('#datos_percepcion').html('');
                // $('#suma_percepcion').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
                $.each(res, function (key, value) {
                    
                    $.ajax({
                                url: "{{ route('getPerception_employee') }}?employee_id="+countryId,
                                type: 'get',
                                success: function (res2) {
                                    $.each(res2, function (key2, value2) {
                                        if (value.perception_id == 1) {
                                            if(value.perception_id == value2.perception_id){
                                                other_perception = parseFloat(value2.sum);
                                                $('#suma_percepcion').append('<td width="10%" style="text-align: center; border: 0px solid black; ">'+ value.name + ':</td>');
                                                $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.perception_id+'" name="percepcion_'+value.perception_id+'" type="number" step="0.01" value="'+other_perception+'" required readonly/></td>');
                                            }
                                        }else{
                                            setTimeout(function() {
                                                if(value.perception_id == value2.perception_id){
                                                    // alert(value2.sum)
                                                    other_perception = parseFloat(value2.sum);
                                                    $('#suma_percepcion').append('<td width="10%" style="text-align: center; border: 0px solid black; ">'+ value.name + ':</td>');
                                                    $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.perception_id+'" name="percepcion_'+value.perception_id+'" type="number" step="0.01" value="'+other_perception+'" required/></td>');
                                                }
                                            }, 500);
                                    }
                                        // if(value.perception_id == value2.perception_id){
                                        //     // alert(value2.sum)
                                        //     other_perception = parseFloat(value2.sum);
                                        //     $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.perception_id+'" name="percepcion_'+value.perception_id+'" type="number" step="0.01" value="'+other_perception+'" required/></td>');
                                        // }
                                    });
                                }
                            });
                            
                });
                setTimeout(function() {
                    $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input type="button" value="Calcular" id="boton" style="background-color: #646464 ; border: none; color: white; padding: 4px 8px; text-decoration: none; margin: 4px 2px; cursor: pointer;"/></td>');
                    let p = document.getElementById("boton");
                    p.onclick = muestraAlerta;  
                }, 1000);
                // $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input type="button" value="Calcular" id="boton" style="background-color: #646464 ; border: none; color: white; padding: 4px 8px; text-decoration: none; margin: 4px 2px; cursor: pointer;"/></td>');
                          
            }
        });

        $.ajax({
            url: "{{ route('getDeductions_payroll') }}",
            type: 'get',
                    
            success: function (res) {
                        
                $.each(res, function (key, value) {
                    $('#deduccion').append('<td width="10%" style="text-align: center; border: 0px solid black; ">'+ value
                            .name + ':</td>');

                    // $('#deduction').append('<td width="10%" style="text-align: center;">' + value.key  + '</td>');
                            
                    isr = (salario-tabulador_inicial)*porcentaje+tabulador_anterior;
                    // alert("Calculando....");   
                    setTimeout(function() {
                        $.ajax({
                            url: "{{ route('getDeductions_employee') }}?employee_id="+countryId,
                            type: 'get',
                            success: function (res2) {
                                $.each(res2, function (key2, value2) {
                                    if (value.deduction_id != "2") {
                                        setTimeout(function() {
                                            if(value.deduction_id == value2.deduction_id){
                                                // alert(value2.sum);
                                                other_deduction = parseFloat(value2.sum);
                                                $('#deduction_data').append('<td width="10%" style="text-align: center;"><input id="deduccion_'+value.key+'" name="deduccion_'+value.deduction_id+'" type="number" step="0.01" value="'+other_deduction.toFixed(2)+'" required/></td>');
                                            }
                                        }, 500);
                                    }else{
                                        if(value.deduction_id == value2.deduction_id){
                                            // alert(value2.sum)
                                            other_deduction = parseFloat(value2.sum);
                                            $('#deduction_data').append('<td width="10%" style="text-align: center;"><input id="deduccion_'+value.key+'" name="deduccion_'+value.deduction_id+'" type="number" step="0.01" value="'+other_deduction.toFixed(2)+'" required readonly/></td>');
                                        }
                                        /*setTimeout(function() {
                                            if(value.deduction_id == value2.deduction_id){
                                                // alert(value2.sum)
                                                other_deduction = parseFloat(value2.sum);
                                                $('#deduction_data').append('<td width="10%" style="text-align: center;"><input id="deduccion_'+value.key+'" name="deduccion_'+value.deduction_id+'" type="number" step="0.01" value="'+other_deduction.toFixed(2)+'" required readonly/></td>');
                                            }
                                        }, 500);*/
                                    }
                                });
                            }
                        });
                    }, 1000);
                });
            }
        });
        function muestraAlerta(evento) {
            $('#totales').html('');
            // alert("Hola");
            var quincena = 0;
            if(checkBox.checked) {
                // alert("checked");
                var allInputs = document.querySelectorAll('input[type="number"]');
                suma = 0;
                resta = 0;
                for (var i = 0; i < allInputs.length; i++) {
                    var name_data = allInputs[i].name.split('_');
                    if (name_data[0] == 'percepcion') {
                        if (name_data[1] == 1) {
                            // alert(allInputs[i].value);
                            allInputs[i].value=salario.toFixed(2);
                            suma = suma + parseFloat(allInputs[i].value);
                        }else{
                            suma = suma + parseFloat(allInputs[i].value);
                        }
                    }else{
                        if (name_data[1] == 2) {
                            allInputs[i].value=isr.toFixed(2);
                            resta = resta + parseFloat(allInputs[i].value);
                        }else{
                            resta = resta + parseFloat(allInputs[i].value);
                        }
                    }
                }
                suma = suma - resta;
                $('#totales').append('<td width="100%" colspan="6" style="text-align: right;">'+
                                    '<br><label for="">Total: </label>'+
                                    '<input type="number" id="total" name="total" value="'+suma.toFixed(2)+'" readonly>'+
                                    '</td>'+
                                '</tr>');
            }else{
                // alert("Es quincenal");
                quincena = isr/2;
                var allInputs = document.querySelectorAll('input[type="number"]');
                suma = 0;
                resta = 0;
                for (var i = 0; i < allInputs.length; i++) {
                    var name_data = allInputs[i].name.split('_');
                    if (name_data[0] == 'percepcion') {
                        if (name_data[1] == 1) {
                            // alert(allInputs[i].value);
                            salarios=salario/2;
                            allInputs[i].value=salarios.toFixed(2);
                            suma = suma + parseFloat(allInputs[i].value);
                            // alert(salarios);
                        }else{
                            suma = suma + parseFloat(allInputs[i].value);
                        }
                    }else{
                        if (name_data[1] == 2) {
                            allInputs[i].value=quincena.toFixed(2);
                            resta = resta + parseFloat(allInputs[i].value);
                        }else{
                            resta = resta + parseFloat(allInputs[i].value);
                        }
                    }
                }
                suma = suma - resta;
                $('#totales').append('<td width="100%" colspan="6" style="text-align: right;">'+
                                    '<br><label for="">Total: </label>'+
                                    '<input type="number" id="total" name="total" value="'+suma.toFixed(2)+'" readonly>'+
                                    '</td>'+
                                '</tr>');
            }
        }

        setTimeout(function() {
            var allInputs = document.querySelectorAll('input[type="number"]');
                suma = 0;
                resta = 0;
                for (var i = 0; i < allInputs.length; i++) {
                    var name_data = allInputs[i].name.split('_');
                    if (name_data[0] == 'percepcion') {
                        if (name_data[1] == 1) {
                            // alert(salario);
                            if(salario == parseFloat(allInputs[i].value)){
                                $("#mes").prop( "checked", true );
                            }
                            suma = suma + parseFloat(allInputs[i].value);
                            
                        }else{
                            suma = suma + parseFloat(allInputs[i].value);
                        }
                    }else{
                        if (name_data[1] == 2) {
                            // allInputs[i].value=quincena.toFixed(2);
                            resta = resta + parseFloat(allInputs[i].value);
                        }else{
                            resta = resta + parseFloat(allInputs[i].value);
                        }
                    }
                }
                suma = suma - resta;
                $('#totales').append('<td width="100%" colspan="6" style="text-align: right;">'+
                                    '<br><label for="">Total: </label>'+
                                    '<input type="number" id="total" name="total" value="'+suma.toFixed(2)+'" readonly>'+
                                    '</td>'+
                                '</tr>');
        }, 2000);
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>