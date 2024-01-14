<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Month;
use App\Models\TypePayroll;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;

use DB;
use Resources;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payrolls = Payroll::all();
        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $payrolls = Payroll::all();
        $months = Month::all();
        $type_payrolls = TypePayroll::all();
        return view('payrolls.create', compact('payrolls','months','type_payrolls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollRequest $request)
    {
        //
        $payrolls = $request->except('_token');
        Payroll::insert($payrolls);
        // return response()->json($payrolls);
        $payroll = Payroll::latest('payroll_id')->first();
        // $store_procedure = DB::select('call create_payroll(?)', [$payroll->payroll_id]);
        $store_procedure = DB::select('call oaxaca.create_payroll('.$payroll->payroll_id.',"'.$payroll->description.'",'.$payroll->user_id.')');
        // return response()->json($payroll->payroll_id);
        return redirect()->route('payrolls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        //
        $months = Month::all();
        return view('payrolls.show', compact('payroll','months'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
        $months = Month::all();
        $month = Month::select('month_id','name')->where('month_id','=',$payroll->month_id)->get();
        $type_payrolls = TypePayroll::all();
        $typePayroll = TypePayroll::select('type_payroll_id','key','name')->where('type_payroll_id','=',$payroll->type_payroll_id)->get();
        // return response()->json($type_payroll);
        return view('payrolls.edit', compact('payroll', 'months','month','type_payrolls','typePayroll'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        //
        $payrolls = $request->except('_token','_method');
        Payroll::where('payroll_id','=',$payroll->payroll_id) -> update($payrolls);
        return redirect()->route('payrolls.index');
        // return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
        $payroll->delete();
 
        return redirect()->route('payrolls.index');
        // return response()->json($payroll);
    }
}
