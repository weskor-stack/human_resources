<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Contrato') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <div>
                        <x-label for="name" value="{{ __('Empleado') }}" />
                        <x-input disabled id="name" class="block mt-1 w-full" type="text" name="name" value="{{$employees[0]->name}} {{$employees[0]->last_name1}} {{$employees[0]->last_name2}}" required autofocus autocomplete="name" />
                        <input type="hidden" name="employee" id="employee" value="{{$employees[0]->employee_id}}">
                    </div>

                    <br>

                    <div>
                        <x-label for="user_id" value="{{ __('Contrato') }}" />
                        <x-input disabled id="user_id" class="block mt-1 w-full" type="text" name="user_id" value="{{ $type_contract[0]->name }}" required autofocus autocomplete="user_id"/>
                    </div>

                    <br>

                    <div id="tipo_pago">
                        <x-label for="type_payment_id" value="{{ __('Tipo de pago') }}" />
                        <select name="type_payment_id" disabled id="type_payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($type_payments as $type_payment)
                                @if($type_payment->type_payment_id == $contractJob->type_payment_id)
                                    <option value="{{$type_payment->type_payment_id}}" selected>{{$type_payment->name}}</option>
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
                                <select name="bank_id" disabled id="bank_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($banks as $bank)
                                        @if($bank->bank_id == $bank_account->bank_id)
                                            <option value="{{ $bank->bank_id }}" selected>{{$bank->name}}</option>
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
                                <x-input id="account" disabled class="block mt-1 w-full" maxlength="20" type="text" name="account" value="{{$bank_account->account}}"  autofocus autocomplete="account" />
                            </div>

                            <div id="cuenta_clabe">
                                <x-label for="clabe" value="{{ __('Clabe') }}" />
                                <x-input id="clabe" disabled class="block mt-1 w-full" maxlength="18" type="text" name="clabe" value="{{$bank_account->clabe}}"  autofocus autocomplete="clabe" />
                            </div>

                            <div id="tarjeta">
                                <x-label for="card" value="{{ __('Tarjeta') }}" />
                                <x-input id="card" disabled class="block mt-1 w-full" maxlength="16" type="text" name="card" value="{{$bank_account->card}}"  autofocus autocomplete="card" />
                            </div>

                            <div id="predeterminada">
                                <x-label for="default" value="{{ __('Cuenta predeterminada') }}" />
                                @if($bank_account->default == 1)
                                    <input type="checkbox" name="default" id="default" checked disabled>
                                @else
                                    <input type="checkbox" name="default" id="default" disabled>
                                @endif
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
                                <x-input id="account" class="block mt-1 w-full" maxlength="20" type="text" name="account" :value="old('account')"  autofocus autocomplete="account" />
                            </div>

                            <div id="cuenta_clabe" hidden>
                                <x-label for="clabe" value="{{ __('Clabe') }}" />
                                <x-input id="clabe" class="block mt-1 w-full" maxlength="18" type="text" name="clabe" :value="old('clabe')"  autofocus autocomplete="clabe" />
                            </div>

                            <div id="tarjeta" hidden>
                                <x-label for="card" value="{{ __('Tarjeta') }}" />
                                <x-input id="card" class="block mt-1 w-full" maxlength="16" type="text" name="card" :value="old('card')"  autofocus autocomplete="card" />
                            </div>

                            <div id="predeterminada" hidden>
                                <x-label for="default" value="{{ __('Cuenta predeterminada') }}" />
                                <input type="checkbox" name="default" id="default">
                            </div>
                        </div>
                    @endif

                    <br>

                    <div>
                        <x-label for="salary" value="{{ __('Salario') }}" />
                        <x-input id="salary" disabled class="block mt-1 w-full" type="number" name="salary" value="{{ round($contractJob->salary) }}" required autofocus autocomplete="salary" step="0.01"/>
                    </div>
                        
                    <div hidden>
                        <x-label for="user_id" value="{{ __('User') }}" />
                        <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>