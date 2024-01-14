<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Editar Impuesto') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
 
                    <form method="POST" action="{{ route('income_taxes.update', $incomeTax) }}">
                        @csrf
                        @method('PUT')
 
                        <div>
                            <table style="margin-left: auto; margin-right: auto;">
                                <tr>
                                    <td style="width: 20%; margin: 0 auto;"><strong>Baja:</strong></td>
                                    <td style="width: 20%; margin: 0 auto;"><x-input id="lower" class="block mt-1 w-full" type="number" name="lower" value="{{$incomeTax->lower}}" required autofocus autocomplete="lower" /></td>
                                    <td style="width: 10%; margin: 0 auto;"></td>
                                    <td style="width: 20%; margin: 0 auto;"><strong>Alta:</strong></td>
                                    <td style="width: 20%; margin: 0 auto;"><x-input id="upper" class="block mt-1 w-full" type="number" name="upper" value="{{$incomeTax->upper}}" required autofocus autocomplete="upper" /></td>
                                </tr>
                                <br>
                                <tr>
                                    <td style="width: 20%; margin: 0 auto;"><strong>Tarifa:</strong></td>
                                    <td style="width: 20%; margin: 0 auto;"><x-input id="fee" class="block mt-1 w-full" type="number" name="fee" value="{{$incomeTax->fee}}" required autofocus autocomplete="fee" /></td>
                                    <td style="width: 10%; margin: 0 auto;"></td>
                                    <td style="width: 20%; margin: 0 auto;"><strong>Porcentaje:</strong></td>
                                    <td style="width: 20%; margin: 0 auto;"><x-input id="percentage" class="block mt-1 w-full" type="number" name="percentage" value="{{$incomeTax->percentage}}" required autofocus autocomplete="percentage" /></td>
                                </tr>
                            </table>
                        </div>

                        <div hidden>
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <x-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required autofocus autocomplete="user_id" value="{{ Auth::user()->id }}" />
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