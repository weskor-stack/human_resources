<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Personal_data;
use App\Models\ContactInformation;
use App\Models\TypeBold;

use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Location;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employee::paginate(10);
 
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return response()->json("Hola");
        $type_bloods = TypeBold::all();
        $federal_entity = FederalEntity::select('federal_entity_id','name')->where('status_id','=','1')->get();
        return view('employees.create', compact('type_bloods','federal_entity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $name = $request['name'];
        $last_name1 = $request['last_name1'];
        $last_name2 = $request['last_name2'];

        $nombre = '';
        $apellidoPaterno = '';
        $apellidoMaterno = '';

        $explode_name = explode(' ',$name);
        $explode_last_name1 = explode(' ',$last_name1);
        $explode_last_name2 = explode(' ',$last_name2);

        foreach($explode_name as $x){
            $nombre .=  $x[0];
        }

        foreach($explode_last_name1 as $x){
            $apellidoPaterno .=  $x[0];
        }

        foreach($explode_last_name2 as $x){
            $apellidoMaterno .=  $x[0];
        }

        $key = $nombre.$apellidoPaterno.$apellidoMaterno;

        $request['key'] = $key;
        $request['observation'] = "-";
        $request['status_employee_id'] = 1;

        $datosEmpleado = $request->except('_token','date_birth','nss','rfc','curp','gender','level_schooling','type_blood_id','voter_identification','street','number','zip_code','phone','state','municipality',
        'location_id','email');

        $personal_data_employee = $request->except('_token','key','name','last_name1','last_name2','observation','street','number','zip_code','phone','state','municipality',
        'location_id','status_employee_id','email');

        $contact_information = $request->except('_token','key','name','last_name1','last_name2','observation','date_birth','nss','rfc','curp','gender',
        'level_schooling','type_blood_id','voter_identification','status_employee_id','state','municipality');

        Employee::insert($datosEmpleado);

        $empleado = Employee::latest('employee_id')->first();

        $personal_data_employee['employee_id'] = $empleado->employee_id;

        $contact_information['employee_id'] = $empleado->employee_id;

        Personal_data::insert($personal_data_employee);

        ContactInformation::insert($contact_information);
 
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        $type_bloods = TypeBold::all();
        $federal_entity = FederalEntity::select('federal_entity_id','name')->where('status_id','=','1')->get();
        $personal_data = Personal_data::select('date_birth','nss','rfc','curp','gender','level_schooling','type_blood_id','voter_identification')
        ->where('employee_id','=',$employee->employee_id)->get();
        $personal_data = $personal_data[0];

        $escolaridad = ['Primaria','Secundaria','Bachillerato','Licenciatura','Maestría','Doctorado'];

        $contact_information = ContactInformation::select('street','number','zip_code','phone','email','location_id')->where('employee_id','=',$employee->employee_id)->get();
        $contact_information = $contact_information[0];


        $location_data = Location::select('location_id','name','municipality_id','status_id')->where('status_id','=',1)->where('location_id','=',$contact_information->location_id)
        ->get();

        $municipality_data = Municipality::select('municipality_id','name','federal_entity_id','status_id')->where('municipality_id','=',$location_data[0]->municipality_id)
        ->get();

        $federalEntity = FederalEntity::select('federal_entity_id','name','abbreviation','status_id')->where('federal_entity_id','=',$municipality_data[0]->federal_entity_id)
        ->get();
        
        $locations = Location::all();
        $municipalities = Municipality::all();
        $federalEntities = FederalEntity::all();
        
        // return response()->json($federalEntity);
        return view('employees.edit', compact('employee','type_bloods','federal_entity','personal_data','escolaridad','contact_information',
        'locations','municipalities','federalEntities','federalEntity','municipality_data','location_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
        $name = $request['name'];
        $last_name1 = $request['last_name1'];
        $last_name2 = $request['last_name2'];

        $nombre = '';
        $apellidoPaterno = '';
        $apellidoMaterno = '';

        $explode_name = explode(' ',$name);
        $explode_last_name1 = explode(' ',$last_name1);
        $explode_last_name2 = explode(' ',$last_name2);

        foreach($explode_name as $x){
            $nombre .=  $x[0];
        }

        foreach($explode_last_name1 as $x){
            $apellidoPaterno .=  $x[0];
        }

        foreach($explode_last_name2 as $x){
            $apellidoMaterno .=  $x[0];
        }

        $key = $nombre.$apellidoPaterno.$apellidoMaterno;

        if ($request['observation'] == null) {
            $request['observation'] = "-";
        }
        $request['key'] = $key;
        $request['user_id'] = 9999;

        // $datosEmpleado = $request->except('_token','_method');
        $datosEmpleado = $request->except('_token','_method','date_birth','nss','rfc','curp','gender','level_schooling','type_blood_id','voter_identification','street','number','zip_code','phone','state','municipality',
        'location_id','email');

        $personal_data_employee = $request->except('_token','_method','key','name','last_name1','last_name2','observation','street','number','zip_code','phone','state','municipality',
        'location_id','status_employee_id','email');

        $contact_information = $request->except('_token','_method','key','name','last_name1','last_name2','observation','date_birth','nss','rfc','curp','gender',
        'level_schooling','type_blood_id','voter_identification','status_employee_id','state','municipality');

        // return response()->json($datosEmpleado);

        Employee::where('employee_id','=',$employee->employee_id) -> update($datosEmpleado);

        Personal_data::where('employee_id','=',$employee->employee_id) -> update($personal_data_employee);

        ContactInformation::where('employee_id','=',$employee->employee_id) -> update($contact_information);
        //return response()->json($employee->employee_id);
 
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
 
        return redirect()->route('employees.index');
    }
}
