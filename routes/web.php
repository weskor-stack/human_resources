<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('employees', \App\Http\Controllers\EmployeeController::class);
    Route::resource('statuses', \App\Http\Controllers\StatusController::class);
    Route::resource('personal_datas', \App\Http\Controllers\PersonalDataController::class);
    Route::resource('positions', \App\Http\Controllers\PositionController::class);
    Route::resource('contracts', \App\Http\Controllers\ContractController::class);
    Route::resource('contract_jobs', \App\Http\Controllers\ContractJobController::class);

/////////////////////////////////////////////////////////// Dropdown ///////////////////////////////////////////////////////////////////////
    Route::get('dropdown', [\App\Http\Controllers\DropdownController::class, 'view']);
    Route::get('get-unders', [\App\Http\Controllers\DropdownController::class, 'getUndersecretary'])->name('getUndersecretary');
    Route::get('get-managements', [\App\Http\Controllers\DropdownController::class, 'getManagements'])->name('getManagements');
    Route::get('get-units', [\App\Http\Controllers\DropdownController::class, 'getUnits'])->name('getUnits');
    Route::get('get-departments', [\App\Http\Controllers\DropdownController::class, 'getDepartments'])->name('getDepartments');
    Route::get('get-positions', [\App\Http\Controllers\DropdownController::class, 'getPositions'])->name('getPositions');

    Route::get('get-municipalities', [\App\Http\Controllers\DropdownController::class, 'getMunicipality'])->name('getMunicipality');
    Route::get('get-locations', [\App\Http\Controllers\DropdownController::class, 'getLocation'])->name('getLocation');
    Route::get('get-contracts', [\App\Http\Controllers\DropdownController::class, 'getContracts'])->name('getContracts');
    Route::get('get-typecontracts', [\App\Http\Controllers\DropdownController::class, 'getTypeContracts'])->name('getTypeContracts');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////// Limpiar cache ///////////////////////////////////////////////////////////////////////
    Route::get('/clear-cache', function () {
        echo Artisan::call('config:clear');
        echo Artisan::call('config:cache');
        echo Artisan::call('cache:clear');
        echo Artisan::call('route:clear');
        return view('welcome');
        /**
         * php artisan config:clear
         * php artisan config:cache
         * php artisan cache:clear
         * php artisan route:clear
         */
    });
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
});
