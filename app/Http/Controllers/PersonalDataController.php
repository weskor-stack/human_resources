<?php

namespace App\Http\Controllers;

use App\Models\Personal_data;
use App\Models\Employee;
use App\Http\Requests\StorePersonal_dataRequest;
use App\Http\Requests\UpdatePersonal_dataRequest;

class PersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personal_data = Personal_data::all();
        $employees = Employee::all();
 
        return view('personal_datas.index', compact('personal_data','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employees = Employee::all();//pluck('employee_id','name');
        return view('personal_datas.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonal_dataRequest $request)
    {
        //
        $personal_data = $request->except('_token');

        //return response()->json($personal_data);
        Personal_data::insert($personal_data);
 
        return redirect()->route('personal_datas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Personal_data $personal_data)
    {
        //return response()->json($personal_data);
        //$personal = Personal_data::find($personal_data);
        $employees = Employee::all();
        return view('personal_datas.show', compact('personal_data','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personal_data $personal_data)
    {
        //
        $employees = Employee::all();
        return view('personal_datas.edit', compact('personal_data', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonal_dataRequest $request, Personal_data $personal_data)
    {
        //
        $personal_datas = $request->except('_token','_method');

        //return response()->json($personal_datas);

        Personal_data::where('employee_id','=',$personal_data->employee_id) -> update($personal_datas);
        //return response()->json($employee->employee_id);
 
        return redirect()->route('personal_datas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personal_data $personal_data)
    {
        //
        $personal_data->delete();
 
        return redirect()->route('personal_datas.index');
    }
}
