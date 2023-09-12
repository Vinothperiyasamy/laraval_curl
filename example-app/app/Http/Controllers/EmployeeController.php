<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
// use Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Employee::all(['phone','email']);
        $employees = Employee::orderBy('id', 'desc')->paginate(2);

        // dd($employees);
        return view('index', compact('employees'));
        // return view('index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email|email',
            'joining_date' => 'required',
            'salary' => 'required',
            'phone' => 'required|numeric|unique:employees,phone',

        ], [
            'phone.unique' => 'phone number alrday extis'
        ]);

        // return view('store');
        $data = $request->except('_token');
        // mass assignement
        Employee::create($data);

        // single row insert code in laraval
        // $employee = new Employee; //model name call
        // $employee->name = $data['name'];
        // $employee->email = $data['email'];
        // $employee->joining_date = $data['joining_date'];
        // $employee->salary = $data['salary'];
        // $employee->phone = $data['phone'];
        // $employee->is_active = $data['is_active'];
        // $employee->save();
        // dd('successfully created');

        return redirect()->route('employee.index')->with('message', 'Employee has been successfully!');
        // return Redirect::route('employee.index')->withErrors(['msg' => 'The Message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // $employee = Employee::find($id);

        return view('edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)  
    public function update(Request $request, Employee $employee) //bind method to call route helps, Employee is model name,$employee is get data from route 
    {
        // useing route-model-binding method to find the recodes
        // dd($employee);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email,' . $employee->id . '|email',
            'joining_date' => 'required',
            'salary' => 'required',
            'phone' => 'required|numeric|unique:employees,phone,' . $employee->id,

        ], [
            'phone.unique' => 'phone number alrday extis'
        ]);
        $data = $request->all();
        // $employee = Employee::find($id);
        $employee->update($data);
        return redirect()->route('employee.edit', $employee->id)->with('success', 'Data Updated');
        // dd('successfully updated');
        // mass assignement 
        // $data = $request->all();
        // $employee = Employee::find($id);
        // $employee->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // dd($employee);

        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Deleted');;
    }
}
