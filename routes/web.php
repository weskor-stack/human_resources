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

    Route::resource('payrolls', \App\Http\Controllers\PayrollController::class);
    Route::resource('payroll_deductions', \App\Http\Controllers\PayrollDeductionController::class);

    Route::get('report', [\App\Http\Controllers\PayrollDeductionController::class, 'report'])->name('report');

    Route::resource('payroll_perceptions', \App\Http\Controllers\PayrollPerceptionController::class);

    Route::resource('income_taxes', \App\Http\Controllers\IncomeTaxController::class);

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

    Route::get('get-payrolls', [\App\Http\Controllers\DropdownController::class, 'getPayrolls'])->name('getPayrolls');
    Route::get('get-payrollslocation', [\App\Http\Controllers\DropdownController::class, 'getLocationpayrolls'])->name('getLocationpayrolls');
    Route::get('get-payrollsdeduction', [\App\Http\Controllers\DropdownController::class, 'getDeductions'])->name('getDeductions');
    Route::get('get-payrollsdeductions', [\App\Http\Controllers\DropdownController::class, 'getPayrollDeductions'])->name('getPayrollDeductions');
    Route::get('get-perceptions', [\App\Http\Controllers\DropdownController::class, 'getPerceptions'])->name('getPerceptions');
    Route::get('get-deductions', [\App\Http\Controllers\DropdownController::class, 'getDeductions_payroll'])->name('getDeductions_payroll');

    Route::get('get-salaries', [\App\Http\Controllers\DropdownController::class, 'getSalaries'])->name('getSalaries');
    Route::get('get-taxes', [\App\Http\Controllers\DropdownController::class, 'getTaxes'])->name('getTaxes');
    Route::get('get-taxes2', [\App\Http\Controllers\DropdownController::class, 'getTaxes2'])->name('getTaxes2');
    Route::get('get-deductionemployees', [\App\Http\Controllers\DropdownController::class, 'getDeductions_employee'])->name('getDeductions_employee');
    Route::get('get-perceptionemployees', [\App\Http\Controllers\DropdownController::class, 'getPerception_employee'])->name('getPerception_employee');
    
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
