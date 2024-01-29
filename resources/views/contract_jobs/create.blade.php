<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Nuevo contrato de trabajo') }}
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
                            <x-label for="employee" value="{{ __('Empleado') }}" />
                            <select name="employee" id="employee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#"> {{ __('Seleccionar empleado') }} </option>
                                @foreach ($employees as $employee)
                                    @foreach ($contracts as $contract)
                                        @if($employee->employee_id == $contract->employee_id)
                                            <option value="{{ $employee->employee_id }}"> {{ $employee->name }} {{ $employee->last_name1 }} {{ $employee->last_name2 }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        
                        <br>

                        <div id="field" hidden>
                            <x-label for="contract_id" value="{{ __('Contrato') }}" />
                            <div hidden>
                                <x-input id="contract_id" class="block mt-1 w-full" type="text" name="contract_id" :value="old('contract_id')" required autofocus autocomplete="contract_id" />
                            </div>
                            <x-input disabled id="contract" class="block mt-1 w-full" type="text" name="contract" :value="old('contract')" required autofocus autocomplete="contract" />
                            <!-- <select name="contract_id" id="contract_id"></select> -->
                        </div>

                        <br>

                        <div id="tipo_pago" hidden>
                            <x-label for="type_payment_id" value="{{ __('Tipo de pago') }}" />
                            <select name="type_payment_id" id="type_payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#"> {{ __('Seleccionar tipo de pago') }} </option>
                                @foreach($type_payments as $type_payment)
                                    <option value="{{$type_payment->type_payment_id}}">{{$type_payment->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <br>

                        <div id="titulo_cuenta" hidden>
                            <x-label value="{{ __('Cuenta bancaria') }}" />
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div id="cuentas" hidden>
                                <x-label for="bank_id" value="{{ __('Banco') }}" />
                                <select name="bank_id" id="bank_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="#" disabled>Seleccionar banco</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank->bank_id }}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="estado_cuenta" hidden>
                                <x-label for="status_bank_account_id" value="{{ __('Estado de la cuenta bancaria') }}" />
                                <x-input id="status_bank_account_id" class="block mt-1 w-full" type="text" name="status_bank_account_id" :value="old('status_bank_account_id')" autofocus autocomplete="status_bank_account_id" value="1" />
                            </div>

                            <div id="cuenta" hidden>
                                <x-label for="account" value="{{ __('Cuenta') }}" />
                                <x-input id="account" class="block mt-1 w-full" maxlength="20" type="text" name="account" :value="old('account')"  autofocus autocomplete="account" onkeyup="myFunction()"/>
                            </div>

                            <div id="cuenta_clabe" hidden>
                                <x-label for="clabe" value="{{ __('Clabe') }}" />
                                <x-input id="clabe" class="block mt-1 w-full" maxlength="18" type="text" name="clabe" :value="old('clabe')"  autofocus autocomplete="clabe" onkeyup="myFunction()"/>
                            </div>

                            <div id="tarjeta" hidden>
                                <x-label for="card" value="{{ __('Tarjeta') }}" />
                                <x-input id="card" class="block mt-1 w-full" maxlength="16" type="text" name="card" :value="old('card')"  autofocus autocomplete="card" onkeyup="myFunction()"/>
                            </div>

                            <div id="predeterminada" hidden>
                                <x-label for="default" value="{{ __('Cuenta predeterminada') }}" />
                                <input type="checkbox" name="default" id="default">
                            </div>

                            <div id="observacion" hidden>
                                <x-label for="observation" value="{{ __('Observaciones') }}:" />
                                <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-800 dark:focus:border-blue-800" placeholder="Observaciones" > </textarea>
                            </div>
                        </div>

                        <br>

                        <div id="salario" hidden>
                            <x-label for="salary" value="{{ __('Salario') }}" />
                            <x-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary')" step="0.01" min="0" required autofocus autocomplete="salary" />
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                        </div>
 
                        <div id="boton" hidden>
                            <x-button class="flex mt-4">
                                {{ __('Aceptar') }}
                            </x-button>
                        </div>

                        <!-- <div class="flex mt-4" id="boton" hidden>
                            <x-button>
                                {{ __('Aceptar') }}
                            </x-button>
                        </div> -->
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
            document.getElementById("tipo_pago").removeAttribute("hidden","");
            // document.getElementById("salario").removeAttribute("hidden","");
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
                },
                error: function(error) {
                    // Handle any errors here
                    alert("Favor de vincular el empleado con un contrato");
                    location.replace('https://oaxrh2023.org/contracts/create');
                }
            });
        });

        $('#type_payment_id').on('change', function () {
            var tipoPago = $(this).val();
            if (tipoPago == 1) {
                document.getElementById("titulo_cuenta").removeAttribute("hidden","");
                document.getElementById("cuentas").removeAttribute("hidden","");
                document.getElementById("cuenta").removeAttribute("hidden","");
                document.getElementById("cuenta_clabe").removeAttribute("hidden","");
                document.getElementById("tarjeta").removeAttribute("hidden","");
                document.getElementById("predeterminada").removeAttribute("hidden","");
                document.getElementById("observacion").removeAttribute("hidden","");
                document.getElementById("salario").hidden = true;
                // alert(tipoPago);
            }else{
                document.getElementById("titulo_cuenta").hidden = true;
                document.getElementById("cuentas").hidden = true;
                document.getElementById("cuenta").hidden = true;
                document.getElementById("cuenta_clabe").hidden = true;
                document.getElementById("tarjeta").hidden = true;
                document.getElementById("predeterminada").hidden = true;
                document.getElementById("observacion").hidden = true;
                document.getElementById("salario").removeAttribute("hidden","");
            }
        });
    });
    function myFunction() {
        let x = document.getElementById("account");
        let clabe = document.getElementById("clabe");
        let card = document.getElementById("card");

        if(x.value.length == 20 || clabe.value.length == 18 || card.value.length == 16){
            document.getElementById("salario").removeAttribute("hidden","");
            document.getElementById("boton").removeAttribute("hidden","");
        }else{
            document.getElementById("salario").hidden = true;
            document.getElementById("boton").hidden = true;
        }
        // valor_cuenta = x.value;
        // if (x.value.length==20) {
        //     document.getElementById("salario").removeAttribute("hidden","");
        //     // alert(x.value);
        // }else{
        //     document.getElementById("salario").hidden = true;
        // }
        // alert(x.value);
    }
</script>