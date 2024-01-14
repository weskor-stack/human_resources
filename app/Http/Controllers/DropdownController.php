<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Secretary;
use App\Models\Undersecretary;
use App\Models\Management;
use App\Models\Unit;

use App\Models\TypeContract;

class DropdownController extends Controller
{
    //
    public function view()
    {
        $secretaries = \DB::table('oaxaca.secretary')
            ->get();
        
        return view('dropdown', compact('secretaries'));
    }

    public function getUndersecretary(Request $request)
    {
        $states = \DB::table('oaxaca.undersecretary')
            ->where('secretary_id', $request->secretary_id)
            ->get();
        
        if (count($states) > 0) {
            return response()->json($states);
        }
    }

    public function getManagements(Request $request)
    {
        $managements = \DB::table('oaxaca.management')
            ->where('undersecretary_id', $request->undersecretary_id)
            ->get();
        
        if (count($managements) > 0) {
            return response()->json($managements);
        }
    }

    public function getUnits(Request $request)
    {
        $units = \DB::table('oaxaca.unit')
            ->where('management_id', $request->management_id)
            ->get();
        
        if (count($units) > 0) {
            return response()->json($units);
        }
    }

    public function getDepartments(Request $request)
    {
        $departments = \DB::table('oaxaca.department')
            ->where('unit_id', $request->unit_id)
            ->get();
        
        if (count($departments) > 0) {
            return response()->json($departments);
        }
    }

    public function getPositions(Request $request)
    {
        $positions = \DB::table('oaxaca.position')
            ->where('department_id', $request->department_id)
            ->get();
        
        if (count($positions) > 0) {
            return response()->json($positions);
        }
    }

    public function getMunicipality(Request $request)
    {
        $municipalities = \DB::table('oaxaca.municipality')
            ->where('federal_entity_id', $request->federal_entity_id)
            ->get();
        
        if (count($municipalities) > 0) {
            return response()->json($municipalities);
        }
    }

    public function getLocation(Request $request)
    {
        $locations = \DB::table('oaxaca.location')
            ->where('municipality_id', $request->municipality_id)
            ->get();
        
        if (count($locations) > 0) {
            return response()->json($locations);
        }
    }

    public function getContracts(Request $request)
    {
        $contracts = \DB::table('oaxaca.contract')
            ->where('employee_id', $request->employee_id)
            ->get();
        if (count($contracts) > 0) {
            return response()->json($contracts);
        }
    }

    public function getTypeContracts(Request $request)
    {
        $contracts = \DB::table('oaxaca.contract')
            ->where('employee_id', $request->employee_id)
            ->get();
        
        $type_contract = \DB::table('oaxaca.type_contract')
            ->where('type_contract_id', $contracts[0]->type_contract_id)
            ->get();
        if (count($type_contract) > 0) {
            return response()->json($type_contract);
        }
    }

    public function getPayrolls(Request $request)
    {
        $contracts = \DB::table('oaxaca.contract')
            ->where('employee_id', $request->employee_id)
            ->get();

        $positions = \DB::table('oaxaca.position')
            ->where('position_id', $contracts[0]->position_id)
            ->get();
        
        if (count($positions) > 0) {
            return response()->json($positions);
        }
    }

    public function getLocationpayrolls(Request $request)
    {
        $contracts = \DB::table('oaxaca.contract')
            ->where('employee_id', $request->employee_id)
            ->get();

        $positions = \DB::table('oaxaca.position')
            ->where('position_id', $contracts[0]->position_id)
            ->get();

        $payrolls = \DB::table('oaxaca.location')
            ->where('location_id', $positions[0]->location_id)
            ->get();
        
        if (count($payrolls) > 0) {
            return response()->json($payrolls);
        }
    }

    public function getDeductions(Request $request)
    {
        $payrolls = \DB::table('oaxaca.payroll_deduction')
            ->where('employee_id', $request->employee_id)
            ->get();

            // return response()->json(json_decode($payrolls));
        if ($payrolls="[]") {
            # code...
            $payroll_deduction = \DB::table('oaxaca.deduction')->where('status_id','=','1')->get();
            return response()->json($payroll_deduction);
        }
        $payroll_deduction = \DB::table('oaxaca.deduction')->where('deduction_id',$payrolls[0]->deduction_id)->get();
        if (count($payroll_deduction) > 0) {
            return response()->json($payroll_deduction);
        }
    }

    public function getPayrollDeductions(Request $request)
    {
        $payrolls = \DB::table('oaxaca.payroll_deduction')
            ->where('employee_id', $request->employee_id)
            ->get();

        if ($payrolls=="[]") {
            # code...
            $payroll_deduction = \DB::table('oaxaca.payroll')->get();
            return response()->json($payroll_deduction);
        }else {
            # code...
            $payroll_deduction = \DB::table('oaxaca.payroll')->where('payroll_id',$payrolls[0]->payroll_id)->get();
            return response()->json($payroll_deduction);
        }
        
        // if (count($payrolls) > 0) {
        //     return response()->json($payrolls);
        // }
    }

    public function getPerceptions(Request $request)
    {
        $perceptions = \DB::table('oaxaca.perception')
        ->where('status_id','=','1')->get();

        if (count($perceptions) > 0) {
            return response()->json($perceptions);
        }
    }

    public function getDeductions_payroll()
    {
        $payroll_deduction = \DB::table('oaxaca.deduction')->where('status_id','=','1')->get();
            // return response()->json($payroll_deduction);
        
        if (count($payroll_deduction) > 0) {
            return response()->json($payroll_deduction);
        }
    }

    public function getSalaries(Request $request)
    {
        $payroll_perceptions = \DB::table('oaxaca.payroll_perception')
        ->where('employee_id',$request->employee_id)->get();

        $contracts = \DB::table('oaxaca.contract')
        ->where('employee_id',$request->employee_id)->get();

        $contract_jobs = \DB::table('oaxaca.contract_job')
        ->where('contract_id',$contracts[0]->contract_id)->get();

        if (count($contract_jobs) > 0) {
            return response()->json($contract_jobs);
        }
    }

    public function getTaxes(Request $request)
    {
        $taxes = \DB::table('oaxaca.income_tax')
        ->select('income_tax_id','lower','upper','fee','percentage')->get();

        $contracts = \DB::table('oaxaca.contract')
        ->where('employee_id',$request->employee_id)->get();

        $contract_jobs = \DB::table('oaxaca.contract_job')
        ->where('contract_id',$contracts[0]->contract_id)->get();

        if (count($taxes) > 0) {
            foreach ($taxes as $tax) {
                # code...
                if ($contract_jobs[0]->salary > $tax->lower and $contract_jobs[0]->salary < $tax->upper) {
                    # code...
                    $indice = $tax->income_tax_id;
                    // $indice = $indice - 1;
                    $taxes2 = \DB::table('oaxaca.income_tax')->where('income_tax_id',$tax->income_tax_id)->get();
                    // $taxes3 = \DB::table('oaxaca.income_tax')->where('income_tax_id',$indice)->get();
                    return response()->json($taxes2);
                }
            }
            return response()->json($contract_jobs);
        }
    }

    public function getTaxes2(Request $request)
    {
        $taxes = \DB::table('oaxaca.income_tax')
        ->select('income_tax_id','lower','upper','fee','percentage')->get();

        $contracts = \DB::table('oaxaca.contract')
        ->where('employee_id',$request->employee_id)->get();

        $contract_jobs = \DB::table('oaxaca.contract_job')
        ->where('contract_id',$contracts[0]->contract_id)->get();

        if (count($taxes) > 0) {
            foreach ($taxes as $tax) {
                # code...
                if ($contract_jobs[0]->salary > $tax->lower and $contract_jobs[0]->salary < $tax->upper) {
                    # code...
                    $indice = $tax->income_tax_id;
                    $indice = $indice - 1;
                    $taxes2 = \DB::table('oaxaca.income_tax')->where('income_tax_id',$tax->income_tax_id)->get();
                    $taxes3 = \DB::table('oaxaca.income_tax')->where('income_tax_id',$indice)->get();
                    return response()->json($taxes3);
                }
            }
            return response()->json($contract_jobs);
        }
    }

    public function getDeductions_employee(Request $request)
    {
        $payroll_deduction = \DB::table('oaxaca.payroll_deduction')->where('employee_id',$request->employee_id)->get();
            // return response()->json($payroll_deduction);
        
        if (count($payroll_deduction) > 0) {
            return response()->json($payroll_deduction);
        }
    }

    public function getPerception_employee(Request $request)
    {
        $payroll_deduction = \DB::table('oaxaca.payroll_perception') //->select('payroll_perception_id','employee_id','perception_id','payroll_id','sum')
        ->where('employee_id',$request->employee_id)->get();
            // return response()->json($payroll_deduction);
        
        if (count($payroll_deduction) > 0) {
            return response()->json($payroll_deduction);
        }
    }
}
