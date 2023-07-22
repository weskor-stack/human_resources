<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        //return response()->json($request);
        //Employee::create($request->validated());

        //$request->validate(Employee::$request);
        //$datosEmpleado = $request->all();
        $datosEmpleado = $request->except('_token');

        // return response()->json($datosEmpleado);
        
        Employee::insert($datosEmpleado);
 
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
        /*$employees = Employee::find($employee);
        return response()->json($employee);*/
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
        //$employee->update($request->validated());
        $datosEmpleado = $request->except('_token','_method');

        // return response()->json($datosEmpleado);

        Employee::where('employee_id','=',$employee->employee_id) -> update($datosEmpleado);
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
