<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Nómina
            <!-- {{ __('Add New Contract') }} -->
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('payroll_deductions.store') }}">
                        @csrf
 
                        <div>
                            <x-label for="key" value="{{ __('Employee') }}" />
                            <select name="employee_id" id="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select employee') }}</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{ $employee->name }} {{ $employee->last_name1 }}</option>
                                @endforeach
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
                                                <input type="checkbox"> Mensual
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <br>

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

                        <!-- <div>
                            <x-label for="key" value="{{ __('Deduction') }}" />
                            <select name="deduction_id" id="deduction_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select Deduction') }}</option>
                                @foreach ($deductions as $deduction)
                                    <option value="{{ $deduction->deduction_id }}">{{ $deduction->name }}</option>
                                @endforeach
                            </select>
                        </div> <br> -->

                        <div>
                            <x-label for="key" value="{{ __('Nómina') }}" />
                            <select name="payroll_id" id="payroll_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#" selected disabled>{{ __('Select Payroll') }}</option>
                                @foreach ($payrolls as $payroll)
                                    <option value="{{ $payroll->payroll_id }}">{{ $payroll->key }} - {{ $payroll->description }}</option>
                                @endforeach
                            </select>
                        </div> <br>

                        <!-- <div>
                            <x-label for="sum" value="{{ __('Sum') }}" />
                            <x-input id="sum" class="block mt-1 w-full" type="number" step="0.01" name="sum" :value="old('sum')" required autofocus autocomplete="sum" />
                        </div> <br> -->

                        <div id="reload">
                            <form>
                                <table>
                                    <tr id="suma_percepcion"></tr>
                                    <tr id="suma_percepcion2"></tr>
                                    <tr id="datos_percepcion"></tr>
                                </table>
                            </form>
                        </div>

                        <br>
                        
                        <div id="deduction_id">
                            <table>
                                <tr id="deduccion"></tr>
                                <tr id="deduction"></tr>
                                <tr id="deduction_data"></tr>
                                <tr id="totales"></tr>
                                <!-- <tr id="boton"></tr> -->
                            </table>
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="9999" />
                        </div>
 
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save') }}
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
        document.getElementById("mod").hidden = true;
        document.getElementById("position").hidden = true;
        document.getElementById("reload").hidden = true;
        document.getElementById("deduction_id").hidden = true;
        // $('#reload').load(' #reload')
        
        // $('#reload').load(' #reload')
        var salario = 0;
        var tabulador_inicial = 0;
        var porcentaje = 0;
        var tabulador_anterior = 0;
        var isr = 0;
        var total = 0;

        $('#employee_id').on('change', function () {            
            var countryId = $(this).val();
            // countryId = countryId.split('-');
            // alert(countryId);
            //document.getElementById('customer_id').value= countryId;
            $('#contrato').html('');
            $('#modalidad').html('');
            $('#ubicacion').html('');
            $('#suma_percepcion').html('');
            $('#suma_percepcion2').html('');
            $('#datos_percepcion').html('');
            $('#deduccion').html('');
            $('#deduction').html('');
            $('#deduction_data').html('');
            $('#totales').html('');
            $('#boton').html('');
            let perception_array = [];
            let deduction_array = [];
            // $('#reload').load(' #reload > *')
            // $('#reload').load(' #reload')
            document.getElementById("mod").hidden = false;
            document.getElementById("position").hidden = false;
            document.getElementById("reload").hidden = false;
            document.getElementById("deduction_id").hidden = false;

            var salario = 1;
            var tabulador_inicial = 0;
            var porcentaje = 0;
            var tabulador_anterior = 0;
            var isr = 0;
            var total = 0;
            var suma = 0;
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
                        // tabulador_inicial = parseFloat(tabulador_inicial);
                        porcentaje = parseFloat(value.percentage);
                        // porcentaje = parseFloat(porcentaje);
                        // tabulador_anterior = value2.upper;
                        // alert("fee1: " + value2.income_tax_id);
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

            $.ajax({
                url: "{{ route('getPayrolls') }}?employee_id="+countryId,
                type: 'get',
                success: function (res) {
                    $('#contrato').html("<option value='0' disabled>{{ __('Select Sub secretary')}}</option>");
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
                    $('#modalidad').html("<option value='0' disabled>{{ __('Select Sub secretary')}}</option>");
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
                    $('#ubicacion').html("<option value='0' disabled>{{ __('Select Sub secretary')}}</option>");
                    $.each(res, function (key, value) {
                        $('#ubicacion').append('<option value="' + value
                            .location_id + '">' + value.name  +'</option>');
                    });
                }
            });
            // $.ajax({
            //     url: "{{ route('getDeductions') }}?employee_id="+countryId,
            //     type: 'get',
            //     success: function (res) {
            //         $('#deduction_id').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
            //         $.each(res, function (key, value) {
            //             $('#deduction_id').append('<option value="' + value
            //                 .deduction_id + '">' + value.name  +'</option>');
            //         });
            //     }
            // });
            $.ajax({
                url: "{{ route('getPayrollDeductions') }}?employee_id="+countryId,
                type: 'get',
                success: function (res) {
                    $('#payroll_id').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
                    $.each(res, function (key, value) {
                        $('#payroll_id').append('<option value="' + value
                            .payroll_id + '">' + value.key  +' - '+value.description+'</option>');
                    });
                }
            });
            setTimeout(function() {
                $.ajax({
                    url: "{{ route('getPerceptions') }}?employee_id="+countryId,
                    type: 'get',
                    success: function (res) {
                        $('#datos_percepcion').html('');
                        // $('#suma_percepcion').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
                        $.each(res, function (key, value) {
                            // total += parseFloat(value.key);
                            $('#suma_percepcion').append('<td width="10%" style="text-align: center; border: 0px solid black; ">'+ value
                                .name + ':</td>');

                            $('#suma_percepcion2').append('<td width="10%" style="text-align: center;">' + value.key  + '</td>');

                            if (value.perception_id == "1") {
                                // $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.key+'" name="percepcion_'+value.key+'" type="number" step="0.01" value="22.005" required/></td>');
                                // if (salario == 1) {
                                //     // storage.clear();
                                //     window.location.reload();
                                // }
                                // alert("salario" + salario);
                                // setTimeout(function() {
                                //     $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.key+'" name="percepcion_'+value.key+'" type="number" step="0.01" value="'+salario+'" required/></td>');
                                //     console.log("Yo me imprimo un segundo después, es decir, mil milisegundos después :)");
                                // }, 1000);
                                $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.key+'" name="percepcion_'+value.key+'" type="number" step="0.01" value="'+salario+'" required disabled/></td>');
                            }else{
                                total += parseFloat(value.key);
                                $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input id="percepcion_'+value.key+'" name="percepcion_'+value.key+'" type="number" step="0.01" value="'+value.key+'" required/></td>');
                                // total += document.getElementById("'percepcion_"+value.key+"'").value;
                                
                            }
                            
                        });
                        // $('#datos_percepcion').append('<td width="10%" style="text-align: center;"><input type="button" value="Calcular" id="boton" style="background-color: #646464 ; border: none; color: white; padding: 4px 8px; text-decoration: none; margin: 4px 2px; cursor: pointer;"/></td>');
                        // let p = document.getElementById("boton");
                        // p.onclick = muestraAlerta;
                        
                    }
                });
            }, 2000);
            setTimeout(function() {
                $.ajax({
                    url: "{{ route('getDeductions_payroll') }}",
                    type: 'get',
                    
                    success: function (res) {
                        // $('#suma_percepcion').html("<option value='0' disabled>{{ __('Select deduction')}}</option>");
                        
                        $.each(res, function (key, value) {
                            $('#deduccion').append('<td width="10%" style="text-align: left; border: 0px solid black; ">'+ value
                                .name + ':</td>');

                            $('#deduction').append('<td width="10%" style="text-align: left;">' + value.key  + '</td>');
                            // alert("tabulador_inicial:" + tabulador_inicial);
                            // alert("fee anterior:" + tabulador_anterior);
                            // alert("porcentaje:" + porcentaje);
                            isr = (salario-tabulador_inicial)*porcentaje+tabulador_anterior;
                            
                            setTimeout(function() {
                                $('#deduction_data').append('<td width="10%" style="text-align: left;"><input id="deduccion_'+value.key+'" name="deduccion_'+value.key+'" type="number" step="0.01" value="'+isr.toFixed(2)+'" required disabled/></td>');
                                // document.getElementById("deduction_id").hidden = false;
                                console.log("Yo me imprimo dos segundos después, es decir, dos mil milisegundos después :)");
                            }, 1000);
                            // $('#deduction_data').append('<td width="10%" style="text-align: left;"><input id="deduccion_'+value.key+'" name="deduccion_'+value.key+'" type="number" step="0.01" value="'+isr.toFixed(2)+'" required/></td>');

                            // total = salario + campo_001 + campo_010 + campo_901 + campo_902;
                            // total = salario + parseFloat(campo_001) + parseFloat(campo_010) + parseFloat(campo_901) + parseFloat(campo_902);

                            setTimeout(function() {
                                // alert(suma);
                                // alert("Calculo realizado con exito!!!!");
                                // $(document).ready(function () {
                                //     var campo_001=document.getElementById("percepcion_001").value;
                                //     var campo_010=document.getElementById("percepcion_010").value;
                                //     var campo_901=document.getElementById("percepcion_901").value;
                                //     var campo_902=document.getElementById("percepcion_902").value;

                                //     total = salario + parseFloat(campo_010) + parseFloat(campo_901) + parseFloat(campo_902);
                                    // $('#totales').append('<td width="10%" style="text-align: right;">'+
                                    //         '<label for="">Total: </label>'+
                                    //         '<input type="number" id="total" name="total" value="'+suma.toFixed(2)+'">'+
                                    //         '</td>'+
                                    //     '</tr>');

                                //     // alert(campo_010);
                                //     console.log("Yo me imprimo cuatro segundos después, es decir, cuatro mil milisegundos después :)");
                                // });
                            }, 20000);

                            // $('#totales').append('<td width="10%" style="text-align: right;">'+
                            //             '<label for="">Total: </label>'+
                            //             '<input type="number" id="total" name="total" value="'+total+'">'+
                            //             '</td>'+
                            //         '</tr>');
                        });
                    }
                });
            }, 2000);
            function muestraAlerta(evento) {
                $('#totales').html('');
                var allInputs = document.querySelectorAll('input[type="number"]');
                // alert(allInputs.length);
                suma = 0;
                for (var i = 0; i < allInputs.length; i++) {
                    if (i!=allInputs.length-1) {
                        // alert(allInputs[i].value);
                        suma = suma + parseFloat(allInputs[i].value);
                    }else{
                        // alert(allInputs[i].value);
                        suma = suma - parseFloat(allInputs[i].value);
                    }
                }
                // alert(suma);
                // alert("Evento onclick ejecutado!");
                $('#totales').append('<td width="10%" style="text-align: right;">'+
                                    '<label for="">Total: </label>'+
                                    '<input type="number" id="total" name="total" value="'+suma.toFixed(2)+'">'+
                                    '</td>'+
                                '</tr>');
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script type="text/javascript"src="{{ asset('js/payroll/deductions/js_payroll_deductions.js') }}"></script>
