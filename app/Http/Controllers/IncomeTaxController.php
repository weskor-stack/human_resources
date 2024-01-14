<?php

namespace App\Http\Controllers;

use App\Models\IncomeTax;
use App\Http\Requests\StoreIncomeTaxRequest;
use App\Http\Requests\UpdateIncomeTaxRequest;

class IncomeTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomeTaxes = IncomeTax::paginate(6);
        return view('income_taxes.index', compact('incomeTaxes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('income_taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeTaxRequest $request)
    {
        $impuestos = $request->except('_token');

        // return response()->json($impuestos);
        
        IncomeTax::insert($impuestos);
        return redirect()->route('income_taxes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeTax $incomeTax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeTax $incomeTax)
    {
        return view('income_taxes.edit', compact('incomeTax'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeTaxRequest $request, IncomeTax $incomeTax)
    {
        $impuestos = $request->except('_token','_method');

        // return response()->json($datosEmpleado);

        IncomeTax::where('income_tax_id','=',$incomeTax->income_tax_id) -> update($impuestos);
        //return response()->json($employee->employee_id);
 
        return redirect()->route('income_taxes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeTax $incomeTax)
    {
        //
    }
}
