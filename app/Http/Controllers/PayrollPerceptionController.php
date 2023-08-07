<?php

namespace App\Http\Controllers;

use App\Models\Payroll_perception;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Perception;
use App\Http\Requests\StorePayroll_perceptionRequest;
use App\Http\Requests\UpdatePayroll_perceptionRequest;

class PayrollPerceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payrolls = Payroll_perception::all();
        $employees = Employee::all();
        return view('payrolls.payrollPerceptions.index', compact('payrolls','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $payrolls = Payroll::all();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $perceptions = Perception::select('perception_id','key','name','type_tax_id','status_id')->where('status_id','=','1')->get();  
        return view('payrolls.payrollPerceptions.create', compact('payrolls','employees','perceptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayroll_perceptionRequest $request)
    {
        //
        $payrolls = $request->except('_token');
        Payroll_perception::insert($payrolls);
        // return response()->json($payrolls);
        return redirect()->route('payroll_perceptions.index');
        // return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll_perception $payroll_perception)
    {
        //
        $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_perception->payroll_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_perception->employee_id)->get();
        $perceptions = Perception::select('perception_id','key','name','type_tax_id','status_id')->where('perception_id','=',$payroll_perception->perception_id)->get();  

        $payrolls = $payrolls[0];
        $employees = $employees[0];
        $perceptions = $perceptions[0];

        return view('payrolls.payrollPerceptions.show', compact('payrolls','employees','perceptions','payroll_perception'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll_perception $payroll_perception)
    {
        //
        $payrolls = Payroll::all();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $perceptions = Perception::select('perception_id','key','name','type_tax_id','status_id')->where('status_id','=','1')->get();

        $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_perception->payroll_id)->get();
        $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_perception->employee_id)->get();
        $p_perceptions = Perception::select('perception_id','key','name','type_tax_id','status_id')->where('perception_id','=',$payroll_perception->perception_id)->get();
        
        // return response()->json($payroll_deduction);
        return view('payrolls.payrollPerceptions.edit', compact('payrolls','employees','perceptions','payroll_perception','p_payrolls','p_employees','p_perceptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayroll_perceptionRequest $request, Payroll_perception $payroll_perception)
    {
        //
        $payrolls = $request->except('_token','_method');
        Payroll_perception::where('payroll_perception_id','=',$payroll_perception->payroll_perception_id) -> update($payrolls);
        return redirect()->route('payroll_perceptions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll_perception $payroll_perception)
    {
        //
        $payroll_perception->delete();
        return redirect()->route('payroll_perceptions.index');
    }
}
