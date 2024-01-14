<?php

namespace App\Http\Controllers;

use App\Models\ContractJob;
use App\Models\Contract;
use App\Models\TypeContract;
use App\Models\Employee;
use App\Models\TypePayment;
use App\Models\Bank;
use App\Models\BankAccount;
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
        //$contracts = Contract::all();//
        $contracts = Contract::select('contract_id','employee_id','position_id','type_contract_id','start_date','end_date')->whereNotIn('contract_id', ContractJob::select('contract_id'))->get(); //all();
        $type_contracts = TypeContract::all();
        $employees = Employee::all();//where('status_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereNotIn('employee_id', ContractJob::select('employee_id')->where('status_id', '=', 1))->get();

        $type_payments = TypePayment::select('type_payment_id','key','name','status_id')->where('status_id','=','1')->get();
        $banks = Bank::select('bank_id','key','name','description','status_id')->where('status_id','=','1')->get();
        // return response()->json($contracts);
        return view('contract_jobs.create', compact('contracts','type_contracts','employees','type_payments','banks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractJobRequest $request)
    {
        //
        if (isset($request['default'])==true) {
            $contract_jobs = $request->except('_token','employee','bank_id','status_bank_account_id','account','clabe','card','default');
        }else{
            $contract_jobs = $request->except('_token','employee','bank_id','status_bank_account_id','account','clabe','card');
        }
        
        $banck_account = $request->except('_token','employee','contract_id','type_payment_id','salary');
        if ($request['type_payment_id']=="1") {
            # code...
            if (isset($banck_account['default'])==true) {
                $banck_account['default']='1';
                $banck_account['employee_id']=$request['employee'];
                // return response()->json($banck_account);
                BankAccount::insert($banck_account);
            }else{
                $banck_account['default']='2';
                $banck_account['employee_id']=$request['employee'];
                // return response()->json($banck_account);
                BankAccount::insert($banck_account);
            }
        }
        // return response()->json($contract_jobs);
        ContractJob::insert($contract_jobs);
        //return view('contract_jobs.index');
        return redirect()->route('contract_jobs.index');
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

        $type_payments = TypePayment::select('type_payment_id','key','name','status_id')->where('status_id','=','1')->get();
        $banks = Bank::select('bank_id','key','name','description','status_id')->where('status_id','=','1')->get();

        $bank_account = BankAccount::select('bank_account_id','bank_id','employee_id','status_bank_account_id','account','clabe','card','default')
        ->where('employee_id','=',$contracts[0]->employee_id)->get();

        if($bank_account == "[]"){
            /*return '<script>
                        alert("'.__('Warning').'\n'.__('Service not uploaded').'\n'.__('And you will have to upload the activities again').'"); 
                    </script>';*/
        }else{
             $bank_account = $bank_account[0];
        }

        return view('contract_jobs.show', compact('contractJob','contracts','employees','type_contract','type_payments','banks','bank_account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractJob $contractJob)
    {
        //return response()->json($contractJob);
        $contracts = Contract::select('contract_id','employee_id','type_contract_id')->where('contract_id','=',$contractJob->contract_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$contracts[0]->employee_id)->get();
        $type_contract = TypeContract::select('type_contract_id','name')->where('type_contract_id','=',$contracts[0]->type_contract_id)->get();

        $type_payments = TypePayment::select('type_payment_id','key','name','status_id')->where('status_id','=','1')->get();
        $banks = Bank::select('bank_id','key','name','description','status_id')->where('status_id','=','1')->get();

        $bank_account = BankAccount::select('bank_account_id','bank_id','employee_id','status_bank_account_id','account','clabe','card','default')
        ->where('employee_id','=',$contracts[0]->employee_id)->get();

        if($bank_account == "[]"){
            /*return '<script>
                        alert("'.__('Warning').'\n'.__('Service not uploaded').'\n'.__('And you will have to upload the activities again').'"); 
                    </script>';*/
        }else{
             $bank_account = $bank_account[0];
        }
        // return response()->json($bank_account);
        return view('contract_jobs.edit', compact('contractJob','contracts','employees','type_contract','type_payments','banks','bank_account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractJobRequest $request, ContractJob $contractJob)
    {
        //
        if (isset($request['default'])==true) {
            $contract_jobs = $request->except('_token','_method','employee','bank_id','status_bank_account_id','account','clabe','card','default');
        }else{
            $contract_jobs = $request->except('_token','_method','employee','bank_id','status_bank_account_id','account','clabe','card');
        }

        $banck_account = $request->except('_token','_method','employee','contract_id','type_payment_id','salary');

        $bank_account = BankAccount::select('bank_account_id','bank_id','employee_id','status_bank_account_id','account','clabe','card','default')
        ->where('employee_id','=',$request->employee)->get();

        // return response()->json($request->employee);

        if ($request['type_payment_id']=="1") {
            # code...
            if($bank_account == "[]"){
                if (isset($banck_account['default'])==true) {
                    $banck_account['default']='1';
                    $banck_account['employee_id']=$request['employee'];
                    // return response()->json($banck_account);
                    BankAccount::insert($banck_account);
                }else{
                    $banck_account['default']='2';
                    $banck_account['employee_id']=$request['employee'];
                    // return response()->json($banck_account);
                    BankAccount::insert($banck_account);
                }
            }else{
                if (isset($banck_account['default'])==true) {
                    $banck_account['default']='1';
                    $banck_account['employee_id']=$request['employee'];
                    // return response()->json($banck_account);
                    BankAccount::where('employee_id','=',$request->employee) -> update($banck_account);
                }else{
                    $banck_account['default']='2';
                    $banck_account['employee_id']=$request['employee'];
                    // return response()->json($banck_account);
                    BankAccount::where('employee_id','=',$request->employee) -> update($banck_account);
                }
            }
        }else{
            BankAccount::where('employee_id','=',$request->employee) ->delete();
        }

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
