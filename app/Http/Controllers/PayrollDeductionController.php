<?php

namespace App\Http\Controllers;

use App\Models\Payroll_deduction;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Http\Requests\StorePayroll_deductionRequest;
use App\Http\Requests\UpdatePayroll_deductionRequest;

class PayrollDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payrolls = Payroll_deduction::all();
        $employees = Employee::all();
        return view('payrolls.payrollDeductions.index', compact('payrolls','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $payrolls = Payroll::all();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();  
        return view('payrolls.payrollDeductions.create', compact('payrolls','employees','deductions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayroll_deductionRequest $request)
    {
        //
        $payrolls = $request->except('_token');
        Payroll_deduction::insert($payrolls);
        // return response()->json($payrolls);
        return redirect()->route('payroll_deductions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        $deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();  

        $payrolls = $payrolls[0];
        $employees = $employees[0];
        $deductions = $deductions[0];
        // return response()->json($employees);
        return view('payrolls.payrollDeductions.show', compact('payrolls','employees','deductions','payroll_deduction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = Payroll::all();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();

        $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        $p_deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();
        
        // return response()->json($payroll_deduction);
        return view('payrolls.payrollDeductions.edit', compact('payrolls','employees','deductions','payroll_deduction','p_payrolls','p_employees','p_deductions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayroll_deductionRequest $request, Payroll_deduction $payroll_deduction)
    {
        //
        // return response()->json($request);
        $payrolls = $request->except('_token','_method');
        Payroll_deduction::where('payroll_deduction_id','=',$payroll_deduction->payroll_deduction_id) -> update($payrolls);
        return redirect()->route('payroll_deductions.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll_deduction $payroll_deduction)
    {
        //
        // return response()->json($payroll_deduction);
        $payroll_deduction->delete();
        return redirect()->route('payroll_deductions.index');
    }
}
