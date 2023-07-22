<?php

namespace App\Http\Controllers;

use App\Models\ContractJob;
use App\Models\Contract;
use App\Models\TypeContract;
use App\Models\Employee;
use App\Http\Requests\StoreContractJobRequest;
use App\Http\Requests\UpdateContractJobRequest;

class ContractJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contract_jobs = ContractJob::all();
        $contracts = Contract::all();
        $type_contracts = TypeContract::all();
        $employees = Employee::all();
        return view('contract_jobs.index', compact('contract_jobs','contracts','type_contracts','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $contracts = Contract::all();
        $type_contracts = TypeContract::all();
        $employees = Employee::all();
        return view('contract_jobs.create', compact('contracts','type_contracts','employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractJobRequest $request)
    {
        //
        $contract_jobs = $request->except('_token','employee');
        // return response()->json($contract_jobs);
        ContractJob::insert($contract_jobs);
        return view('contract_jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContractJob $contractJob)
    {
        //
        $contracts = Contract::select('contract_id','employee_id','type_contract_id')->where('contract_id','=',$contractJob->contract_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$contracts[0]->employee_id)->get();
        $type_contract = TypeContract::select('type_contract_id','name')->where('type_contract_id','=',$contracts[0]->type_contract_id)->get();
        return view('contract_jobs.show', compact('contractJob','contracts','employees','type_contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractJob $contractJob)
    {
        //
        $contracts = Contract::select('contract_id','employee_id','type_contract_id')->where('contract_id','=',$contractJob->contract_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$contracts[0]->employee_id)->get();
        $type_contract = TypeContract::select('type_contract_id','name')->where('type_contract_id','=',$contracts[0]->type_contract_id)->get();
        return view('contract_jobs.edit', compact('contractJob','contracts','employees','type_contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractJobRequest $request, ContractJob $contractJob)
    {
        //
        $contract_jobs = $request->except('_token','_method');

        // return response()->json($contract_jobs);

        ContractJob::where('contract_job_id','=',$contractJob->contract_job_id) -> update($contract_jobs);
 
        return redirect()->route('contract_jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractJob $contractJob)
    {
        //
        $contractJob->delete();
        return view('contract_jobs.index');
    }
}
