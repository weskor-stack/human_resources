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
        $secretaries = \DB::table('human_resources.secretary')
            ->get();
        
        return view('dropdown', compact('secretaries'));
    }

    public function getUndersecretary(Request $request)
    {
        $states = \DB::table('human_resources.undersecretary')
            ->where('secretary_id', $request->secretary_id)
            ->get();
        
        if (count($states) > 0) {
            return response()->json($states);
        }
    }

    public function getManagements(Request $request)
    {
        $managements = \DB::table('human_resources.management')
            ->where('undersecretary_id', $request->undersecretary_id)
            ->get();
        
        if (count($managements) > 0) {
            return response()->json($managements);
        }
    }

    public function getUnits(Request $request)
    {
        $units = \DB::table('human_resources.unit')
            ->where('management_id', $request->management_id)
            ->get();
        
        if (count($units) > 0) {
            return response()->json($units);
        }
    }

    public function getDepartments(Request $request)
    {
        $departments = \DB::table('human_resources.department')
            ->where('unit_id', $request->unit_id)
            ->get();
        
        if (count($departments) > 0) {
            return response()->json($departments);
        }
    }

    public function getPositions(Request $request)
    {
        $positions = \DB::table('human_resources.position')
            ->where('department_id', $request->department_id)
            ->get();
        
        if (count($positions) > 0) {
            return response()->json($positions);
        }
    }

    public function getMunicipality(Request $request)
    {
        $municipalities = \DB::table('human_resources.municipality')
            ->where('federal_entity_id', $request->federal_entity_id)
            ->get();
        
        if (count($municipalities) > 0) {
            return response()->json($municipalities);
        }
    }

    public function getLocation(Request $request)
    {
        $locations = \DB::table('human_resources.location')
            ->where('municipality_id', $request->municipality_id)
            ->get();
        
        if (count($locations) > 0) {
            return response()->json($locations);
        }
    }

    public function getContracts(Request $request)
    {
        $contracts = \DB::table('human_resources.contract')
            ->where('employee_id', $request->employee_id)
            ->get();
        if (count($contracts) > 0) {
            return response()->json($contracts);
        }
    }

    public function getTypeContracts(Request $request)
    {
        $contracts = \DB::table('human_resources.contract')
            ->where('employee_id', $request->employee_id)
            ->get();
        
        $type_contract = \DB::table('human_resources.type_contract')
            ->where('type_contract_id', $contracts[0]->type_contract_id)
            ->get();
        if (count($type_contract) > 0) {
            return response()->json($type_contract);
        }
    }
}
