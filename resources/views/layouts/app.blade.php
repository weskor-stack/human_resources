<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" type="image/png" href="{{ url('/img/escudo.png') }}">
        <link rel="shortcut icon" href="{{ url('/img/escudo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="p-0 sm:ml-64">
        <div class="p-0">
        
        <x-banner />

        <div class="min-h-screen bg-gray-100" style="background-image: {{ url('http://localhost/human_resources/public/img/fondo.png') }}">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow" style="background-image: url('http://localhost/human_resources/public/img/encabezado.PNG')">
                    <div class="max-w-7xl mx-auto py-7 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-0 sm:ml-50">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        </div>
        </div> 
    </body>
    <footer style="background-image: url('http://localhost/human_resources/public/img/pie.PNG')">
        <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
            <table style="text-align:left;">
                <thead>
                    <th width="10%"></th>
                    <th colspan="2"><font color="#FFFFFF">Centro Administrativo del Poder Ejecutivo y Judicial "General Porfirio Díaz, Soldado de la Patria"</font></th>
                    <th width="30%"></th>
                </thead>
                <tbody>
                    <tr>
                        <td width="10%"></td>
                        <td colspan="2"><strong><font color="#FFFFFF">Edificio "D" Saúl Martínez Avenida Gerardo Pandal Graff #1</font></strong></td>
                        <td width="30%"></td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <td colspan="2"><strong><font color="#FFFFFF">Reyes Mantecón, San Bartolo Coyotepec, Oaxaca. C.P. 71257</font></strong></td>
                        <td width="30%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </footer>
</html>
