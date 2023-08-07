<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Month;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;

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
        return view('payrolls.create', compact('payrolls','months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayrollRequest $request)
    {
        //
        $payrolls = $request->except('_token');
        Pay_roll::insert($payrolls);
        // return response()->json($payrolls);
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
        // return response()->json($month);
        return view('payrolls.edit', compact('payroll', 'months','month'));
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
