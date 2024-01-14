<?php

namespace App\Http\Controllers;

use App\Models\Payroll_deduction;
use App\Models\Payroll_perception;
use App\Models\Employee;
use App\Models\Contract;
use App\Models\ContractJob;
use App\Models\Payroll;
use App\Models\Deduction;
use App\Models\PayrollEmploye;
use App\Http\Requests\StorePayroll_deductionRequest;
use App\Http\Requests\UpdatePayroll_deductionRequest;
use DB;

class PayrollDeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Payroll $payroll_deduction)
    {
        //
        $datas = $_GET['list'];
        // return response()->json($datas);
        $payrolls = Payroll_deduction::all();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereIn('employee_id', Payroll_perception::select('employee_id')->where('status_employee_id', '=', 1))->get();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereIn('employee_id', Payroll_perception::select('employee_id')->where('payroll_id', '=', $datas))->get();

        // $employees = Employee::all();
        // return response()->json($employees);
        return view('payrolls.payrollDeductions.index', compact('payrolls','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // $payrolls = Payroll::all();
        $datas = $_GET['list'];
        // // $payrolls = Payroll::all();
        $payrolls = Payroll::select('payroll_id','description','key')->where('payroll_id','=',$datas)->get();
        // $employees2 = Employee::select('employee_id','name','last_name1','last_name2')->where('status_id','=','1')->get();
        $employees = Employee::where('status_employee_id','=','1')->select('employee_id','name','last_name1','last_name2')->whereNotIn('employee_id', Payroll_perception::select('employee_id')->where('status_employee_id', '=', 1))->get();

        // $employees_contract_job = Contract::select('contract_id','employee_id')
        //     ->join('contract_job', 'contract.contract_id', '=', 'contract_job.contract_id')
        //     ->join('employee', 'contract.employee_id', '=', 'employee.employee_id')
        //     ->select('employee.name', 'employee.last_name1','employee.last_name2')
        //     ->get();

        $contracts = Contract::all();
        $contract_jobs = ContractJob::all();
        // return response()->json($employees_contract_job);
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();  
        return view('payrolls.payrollDeductions.create', compact('payrolls','employees','deductions','contracts','contract_jobs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayroll_deductionRequest $request)
    {
        //
        $payrolls = $request->except('_token','modalidad','contrato','ubicacion','total');
        $payrolls2 = $request->except('_token');
        $perceptions = $request->except('_token','employee_id','modalidad','contrato','ubicacion','payroll_id','total','user_id');
        $percepcion_count = 0;
        $deduccion_count = 0;
        $payrolls_perceptions;
        $payrolls_deductions;

        $payroll_employee['employee_id'] = $request->employee_id;
        $payroll_employee['payroll_id'] = $request->payroll_id;
        $payroll_employee['user_id'] = $request->user_id;

        // return response()->json($payrolls);
        PayrollEmploye::insert($payroll_employee);
        
        foreach ($payrolls as $key => $value) {
            # code...
            $perception_name = explode("_",$key);
            if($perception_name[0] == "percepcion"){
                $percepcion_count = $percepcion_count + 1;
                $payrolls_perceptions['employee_id'] = $payrolls['employee_id'];
                $payrolls_perceptions['perception_id'] = $perception_name[1];
                $payrolls_perceptions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_perceptions['sum'] = $value;
                $payrolls_perceptions['user_id'] = $payrolls['user_id'];

                // return response()->json($payrolls_perceptions);
                Payroll_perception::insert($payrolls_perceptions);
                
            }elseif ($perception_name[0] == "deduccion") {
                # code...
                $deduccion_count = $deduccion_count + 1;
                $percepcion_count = $percepcion_count + 1;
                $payrolls_deductions['employee_id'] = $payrolls['employee_id'];
                $payrolls_deductions['deduction_id'] = $perception_name[1];
                $payrolls_deductions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_deductions['sum'] = $value;
                $payrolls_deductions['user_id'] = $payrolls['user_id'];

                // return response()->json($perception_name);
                Payroll_deduction::insert($payrolls_deductions);
            }
        }
        // return response()->json($deduccion_count);
        // return response()->json($percepcion_count);
        // return response()->json($payrolls);
        // Payroll_deduction::insert($payrolls);
        // return response()->json($payrolls);
        return redirect()->route('payrolls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)//Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = $_GET['nom'];
        
        // $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        // $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        // $deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();  

        $payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payrolls)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        $payrollDeductions = Payroll_deduction::select('deduction_id')->where('payroll_id','=',$payrolls[0])->get();
        // $deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payrollDeductions)->get();

        $payrolls = $payrolls[0];
        $employees = $employees[0];
        // $deductions = $deductions[0];
        // return response()->json($payrollDeductions);
        return view('payrolls.payrollDeductions.show', compact('payrolls','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)//Payroll_deduction $payroll_deduction)
    {
        //
        $payroll_deduction = $id;
        $payrolls = Payroll::all();
        // $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        $employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        $deductions = Deduction::select('deduction_id','name')->where('status_id','=','1')->get();

        // $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$payroll_deduction->payroll_id)->get();
        // $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        // $p_deductions = Deduction::select('deduction_id','name')->where('deduction_id','=',$payroll_deduction->deduction_id)->get();
        
        // $payroll_employee = Payroll_deduction::select('payroll_deduction_id','employee_id','deduction_id','payroll_id','sum')->where('employee_id','=',$payroll_deduction->employee_id)->get();
        
        $deduction = Payroll_deduction::select('payroll_id')->where('employee_id','=',$employees[0]->employee_id)->get();
        $p_payrolls = Payroll::select('payroll_id','key','description','start_date','end_date','month_id')->where('payroll_id','=',$deduction[0]->payroll_id)->get();
        $p_employees = Employee::select('employee_id','name','last_name1','last_name2')->where('employee_id','=',$id)->get();
        // return response()->json($p_payrolls);
        return view('payrolls.payrollDeductions.edit', compact('payrolls','employees','p_employees','payroll_deduction','p_payrolls'));
        // return view('payrolls.payrollDeductions.edit', compact('payrolls','employees','deductions','payroll_deduction','p_payrolls','p_employees','p_deductions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayroll_deductionRequest $request, Payroll_deduction $payroll_deduction)
    {
        //
        $payrolls = $request->except('_token','_method','modalidad','contrato','ubicacion','total');
        $percepcion_count = 0;
        $deduccion_count = 0;
        $payrolls_perceptions;
        $payrolls_deductions;

        // return response()->json($request);
        foreach ($payrolls as $key => $value) {
            # code...
            $perception_name = explode("_",$key);
            if($perception_name[0] == "percepcion"){
                $percepcion_count = $percepcion_count + 1;
                $payrolls_perceptions['employee_id'] = $payrolls['employee_id'];
                $payrolls_perceptions['perception_id'] = $perception_name[1];
                $payrolls_perceptions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_perceptions['sum'] = $value;
                $payrolls_perceptions['user_id'] = $payrolls['user_id'];

                // return response()->json(Payroll_perception::select('perception_id')->where('employee_id','=',$payrolls_perceptions['employee_id']) ->where('perception_id','=',$perception_name[1]) ->get());
                // Payroll_perception::insert($payrolls_perceptions);
                Payroll_perception::where('perception_id','=',$perception_name[1]) -> where('employee_id','=',$payrolls['employee_id'])->update($payrolls_perceptions);
                
            }elseif ($perception_name[0] == "deduccion") {
                # code...
                $deduccion_count = $deduccion_count + 1;
                $percepcion_count = $percepcion_count + 1;
                $payrolls_deductions['employee_id'] = $payrolls['employee_id'];
                $payrolls_deductions['deduction_id'] = $perception_name[1];
                $payrolls_deductions['payroll_id'] = $payrolls['payroll_id'];
                $payrolls_deductions['sum'] = $value;
                $payrolls_deductions['user_id'] = $payrolls['user_id'];

                // return response()->json($payrolls_deductions);
                // Payroll_deduction::insert($payrolls_deductions);
                Payroll_deduction::where('deduction_id','=',$perception_name[1]) ->where('employee_id','=',$payrolls['employee_id'])->update($payrolls_deductions);
            }
        }
        // return response()->json($payrolls_deductions);
        // return response()->json($payrolls);
        // $payrolls = $request->except('_token','_method');
        // Payroll_deduction::where('payroll_deduction_id','=',$payroll_deduction->payroll_deduction_id) -> update($payrolls);
        return redirect()->route('payrolls.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll_deduction $payroll_deduction)
    {
        //
        return response()->json($payroll_deduction);
        $payroll_deduction->delete();
        return redirect()->route('payroll_deductions.index');
    }
}
