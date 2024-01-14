<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\Secretary;
use App\Models\Undersecretary;
use App\Models\Management;
use App\Models\Unit;
use App\Models\Position;
use App\Models\Department;
use App\Models\TypeContract;
use App\Models\StatusContract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contracts = Contract::all();
        $employees = Employee::all();
        $positions = Position::all();
        // return response()->json($contracts);
        return view('contracts.index', compact('contracts','employees','positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereNotIn('employee_id', Contract::select('employee_id')->where('status_employee_id', '=', 1))->get();
        $secretaries = Secretary::select('secretary_id','name','status_id')->where('status_id','=','1')->get();
        $type_contracts = TypeContract::select('type_contract_id','key','name','status_id')->where('status_id','=','1')->get();
        $status_contracts = StatusContract::all();
        return view('contracts.create', compact('employees','secretaries','type_contracts','status_contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        //
        $contracts = Contract::all();
        $employees = Employee::all();
        $positions = Position::all();
        $contract = $request->except('_token','secretary','undersecreatries','managements','units','department_id');
        if ($request['check_attendance'] == null) {
            # code...
            $request['check_attendance'] = $request['check_attendance2'];
            $contract = $request->except('_token','secretary','undersecreatries','managements','units','department_id','check_attendance2');
            // $request['check_attendance'] = $request['check_attendance2'];
            // return response()->json($contract);
            Contract::insert($contract);
        }else{
            $contract = $request->except('_token','secretary','undersecreatries','managements','units','department_id','check_attendance2');
            // return response()->json($contract);
            Contract::insert($contract);
        }
        //return response()->json($request);
        // Contract::insert($contract);
        // return view('contracts.index', compact('contracts','employees','positions'));
        return redirect()->route('contracts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
        $employees = Employee::all();
        $positions = Position::all();
        $type_contracts = TypeContract::all();
        $status = StatusContract::all();
        return view('contracts.show', compact('contract','employees','positions','type_contracts','status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
        $position = Position::select('position_id','name','department_id')->where('position_id','=',$contract->position_id)->get();
        $department = Department::select('department_id','name','unit_id')->where('department_id','=',$position[0]->department_id)->get();
        $unit = Unit::select('unit_id','name','management_id')->where('unit_id','=',$department[0]->unit_id)->get();
        $management = Management::select('management_id','name','undersecretary_id')->where('management_id','=',$unit[0]->management_id)->get();
        $undersecretary = Undersecretary::select('undersecretary_id','name','secretary_id')->where('undersecretary_id','=',$management[0]->undersecretary_id)->get();
        $secretary = Secretary::select('secretary_id','name','status_id')->where('secretary_id','=',$undersecretary[0]->secretary_id)->get();

        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('status_employee_id','=','1')->get();
        $employee_data = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$contract->employee_id)->get();
        $secretaries = Secretary::select('secretary_id','name','status_id')->where('status_id','=','1')->get();
        $type_contracts = TypeContract::select('type_contract_id','key','name','status_id')->where('status_id','=','1')->get();
        $type_contract = TypeContract::select('type_contract_id','name')->where('type_contract_id','=',$contract->type_contract_id)->get();

        $status_contracts = StatusContract::select('status_contract_id','name')->where('status_contract_id','=',$contract->status_contract_id)->get();
        $status = StatusContract::all();
        // return response()->json($secretary);
        return view('contracts.edit', compact('contract','employees','employee_data','secretaries','position','department','unit','management','undersecretary','secretary',
        'type_contracts','type_contract','status_contracts','status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        //
        $contracts = $request->except('_token','_method','undersecreatries','managements','municipality','department_id');

        if ($request['check_attendance'] == null) {
            # code...
            $request['check_attendance'] = 2;
            $contracts = $request->except('_token','_method','secretary','undersecreatries','managements','units','department_id','check_attendance2');
            // $request['check_attendance'] = $request['check_attendance2'];
            // return response()->json($request);
            Contract::where('contract_id','=',$contract->contract_id) -> update($contracts);
        }else{
            $contracts = $request->except('_token','_method','secretary','undersecreatries','managements','units','department_id','check_attendance2');
            // return response()->json($contract);
            Contract::where('contract_id','=',$contract->contract_id) -> update($contracts);
        }

        // Contract::where('contract_id','=',$contract->contract_id) -> update($contracts);
        //return response()->json($employee->employee_id);
 
        return redirect()->route('contracts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
        $contract->delete();
        return view('contracts.index');

    }
}
