<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar contrato') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('contract_jobs.update', $contractJob) }}">
                        @csrf
                        @method('PUT')
 
                        
                        <div>
                            <x-label for="name" value="{{ __('Empleado') }}" />
                            <x-input disabled id="name" class="block mt-1 w-full" type="text" name="name" value="{{$employees[0]->name}} {{$employees[0]->last_name1}} {{$employees[0]->last_name2}}" required autofocus autocomplete="name" />
                            <input type="hidden" name="employee" id="employee" value="{{$employees[0]->employee_id}}">
                        </div>

                        <div hidden>
                            <x-input id="contract_id" class="block mt-1 w-full" type="text" name="contract_id" value="{{ round($contractJob->contract_id) }}" required autofocus autocomplete="contract_id" />
                        </div>

                        
                        <div>
                            <x-label for="user_id" value="{{ __('Contrato') }}" />
                            <x-input disabled id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $type_contract[0]->name }}" required autofocus autocomplete="user_id"/>
                        </div>

                        <br>

                        <div id="tipo_pago">
                            <x-label for="type_payment_id" value="{{ __('Tipo de pago') }}" />
                            <select name="type_payment_id" id="type_payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="#"> {{ __('Seleccionar tipo de pago') }} </option>
                                @foreach($type_payments as $type_payment)
                                    @if($type_payment->type_payment_id == $contractJob->type_payment_id)
                                        <option value="{{$type_payment->type_payment_id}}" selected>{{$type_payment->name}}</option>
                                    @else
                                        <option value="{{$type_payment->type_payment_id}}">{{$type_payment->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        
                        <br>

                        @if($contractJob->type_payment_id == 1)
                            <div id="titulo_cuenta">
                                <x-label value="{{ __('Cuenta bancaria') }}" />
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div id="cuentas">
                                    <x-label for="bank_id" value="{{ __('Banco') }}" />
                                    <select name="bank_id" id="bank_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="#" disabled>Seleccionar banco</option>
                                        @foreach($banks as $bank)
                                            @if($bank->bank_id == $bank_account->bank_id)
                                                <option value="{{ $bank->bank_id }}" selected>{{$bank->name}}</option>
                                            @else
                                                <option value="{{ $bank->bank_id }}">{{$bank->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div id="estado_cuenta" hidden>
                                    <x-label for="status_bank_account_id" value="{{ __('Estado de la cuenta bancaria') }}" />
                                    <x-input id="status_bank_account_id" class="block mt-1 w-full" type="text" name="status_bank_account_id" :value="old('status_bank_account_id')" autofocus autocomplete="status_bank_account_id" value="1" />
                                </div>

                                <div id="cuenta">
                                    <x-label for="account" value="{{ __('Cuenta') }}" />
                                    <x-input id="account" class="block mt-1 w-full" maxlength="20" type="text" name="account" value="{{$bank_account->account}}"  autofocus autocomplete="account" onkeyup="myFunction()"/>
                                </div>

                                <div id="cuenta_clabe">
                                    <x-label for="clabe" value="{{ __('Clabe') }}" />
                                    <x-input id="clabe" class="block mt-1 w-full" maxlength="18" type="text" name="clabe" value="{{$bank_account->clabe}}"  autofocus autocomplete="clabe" onkeyup="myFunction()"/>
                                </div>

                                <div id="tarjeta">
                                    <x-label for="card" value="{{ __('Tarjeta') }}" />
                                    <x-input id="card" class="block mt-1 w-full" maxlength="16" type="text" name="card" value="{{$bank_account->card}}"  autofocus autocomplete="card" onkeyup="myFunction()"/>
                                </div>

                                <div id="predeterminada">
                                    <x-label for="default" value="{{ __('Cuenta predeterminada') }}" />
                                    @if($bank_account->default == 1)
                                        <input type="checkbox" name="default" id="default" checked>
                                    @else
                                        <input type="checkbox" name="default" id="default">
                                    @endif
                                </div>

                                <div id="observacion">
                                    <x-label for="observation" value="{{ __('Observaciones') }}:" />
                                    <textarea id="observation" name="observation" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-white dark:border-gray-300 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-800 dark:focus:border-blue-800" placeholder="Observaciones" >{{$bank_account->observation}}</textarea>
                                </div>
                                
                            </div>
                        @else
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
                                    <x-input id="account" class="block mt-1 w-full" maxlength="20" type="text" name="account" :value="old('account')"  autofocus autocomplete="account" onkeyup="myFunction()" />
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
                        @endif

                        <br>

                        <div id="salario">
                            <x-label for="salary" value="{{ __('Salario') }}" />
                            <x-input id="salary" class="block mt-1 w-full" type="number" name="salary" value="{{ round($contractJob->salary) }}" required autofocus autocomplete="salary" step="0.01" min="0"/>

                        </div>
                        
                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                        </div>
 
                        <div id="boton">
                            <x-button class="flex mt-4">
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
        $('#employee').on('change', function () {
            document.getElementById("field").removeAttribute("hidden","");
            document.getElementById("tipo_pago").removeAttribute("hidden","");
            document.getElementById("salario").removeAttribute("hidden","");
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
                document.getElementById("boton").removeAttribute("hidden","");
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