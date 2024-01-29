<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use App\Models\Undersecretary;
use App\Models\Management;
use App\Models\Unit;
use App\Models\Position;
use App\Models\TypePosition;
use App\Models\Department;
use App\Models\Status;
use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Location;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $positions = Position::paginate(10);
        $departments = Department::all();
        $statuses = Status::all();
        $locations = Location::all();
 
        return view('positions.index', compact('positions','departments','statuses','locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return response()->json("Hola");
        $secretaries = Secretary::select('secretary_id','name')->where('status_id','=','1')->get();
        $undersecreatries = Undersecretary::all();
        $managements = Management::all();
        $units = Unit::all();
        $departments = Department::all();
        $statuses = Status::all();

        $federal_entity = FederalEntity::select('federal_entity_id','name')->where('status_id','=','1')->get();
        $locations = Location::all();
        $type_positions = TypePosition::select('key','name','status_id')->where('status_id','=','1')->get();
        return view('positions.create', compact('departments','statuses','locations','secretaries','undersecreatries','managements',
    'units','federal_entity','type_positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        //
         //$request->validate(Employee::$request);
        //$datosEmpleado = $request->all();
        $name = $request['name'];
        $nombre = '';
        $explode_name = explode(' ',$name);
        foreach($explode_name as $x){
            $nombre .=  $x[0];
        }
        $key = $nombre;
        $request['key'] = $key;
        
        $positions = $request->except('_token','secretary','undersecreatries','managements','units','state','municipality');

        // return response()->json($nombre);

        Position::insert($positions);
 
        return redirect()->route('positions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
        $departments = Department::all();
        $statuses = Status::all();
        $locations = Location::all();
        return view('positions.show', compact('position','departments','statuses','locations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        $locations = Location::select('location_id','key','name','municipality_id','status_id')->where('location_id','=',$position->location_id)->get();
        $municipalities = Municipality::select('municipality_id','key','name','federal_entity_id','status_id')->where('municipality_id','=',$locations[0]->municipality_id)->get();
        $federal_entity = FederalEntity::select('federal_entity_id','key','name','status_id')->where('federal_entity_id','=',$municipalities[0]->federal_entity_id)->get();
        $federal_entity2 = FederalEntity::select('federal_entity_id','name')->where('status_id','=','2')->get();
        
        $statuses = Status::select('status_id','name')->where('status_id','=',$position->status_id)->get();

        $statuses_2 = Status::all();

        $departments = Department::select('department_id','name','unit_id','status_id')->where('department_id','=',$position->department_id)->get();
        $units = Unit::select('unit_id','name','management_id','status_id')->where('unit_id','=',$departments[0]->unit_id)->get();
        $managements = Management::select('management_id','name','undersecretary_id','status_id')->where('management_id','=',$units[0]->management_id)->get();
        $undersecreatries = Undersecretary::select('undersecretary_id','name','secretary_id','status_id')->where('undersecretary_id','=',$managements[0]->undersecretary_id)->get();
        $secretaries = Secretary::select('secretary_id','name','status_id')->where('secretary_id','=',$undersecreatries[0]->secretary_id)->get();

        $secretary = Secretary::select('secretary_id','name')->where('status_id','=','1')->get();
        
        $type_positions = TypePosition::select('key','name','status_id')->where('status_id','=','1')->get();

        $type_position = TypePosition::select('key','name','status_id')->where('status_id','=','1')->where('type_position_id','=',$position->type_position_id)->get();

        // return response()->json($position);
        return view('positions.edit', compact('position','departments','statuses','statuses_2','locations','secretary','secretaries','undersecreatries','managements','units','federal_entity','federal_entity2',
        'municipalities','type_positions','type_position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        //

        $name = $request['name'];
        $nombre = '';
        $explode_name = explode(' ',$name);
        foreach($explode_name as $x){
            $nombre .=  $x[0];
        }
        $key = $nombre;
        $request['key'] = $key;
        
        $positions = $request->except('_token','_method','undersecreatries','managements','municipality','units');

        // return response()->json($positions);

        Position::where('position_id','=',$position->position_id) -> update($positions);
        //return response()->json($employee->employee_id);
 
        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
        $position->delete();
 
        return redirect()->route('positions.index');
    }
}
