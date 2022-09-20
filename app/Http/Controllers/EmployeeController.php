<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $input = $request->all();
        
        $input['id_status'] = $input['id_status'] == 'on' ? "4" : "5";

        try
        {
            $employee = Employees::create($input);
        }
        catch(Exception $e)
        {
            return false;
        }

        return view("backend.employees.index");

    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $employees = Employees::selectRaw("id_employee, employee_name, employee_sector, employee_code")
        ->get()->toArray();

        $table = [
        "draw" => $request->input('draw'),
        "recordsTotal" => count($employees),
        "recordsFiltered" => count($employees),
        'data' => $employees,
        ];
        
        return $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id_employee)
    {
        if($id_employee){
            return Employees::selectRaw('employee_name, employee_sector, id_employee, employee_code, employee_email, employee_number, st.id_status')
                            ->leftjoin('status as st', 'employees.id_status', '=', 'st.id_status')
                            ->where('id_employee', $id_employee)
                            ->get()->first();
        }else{
            return FALSE;
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        $employee = Employees::find($id_employee);
        
        $input = $request->all();
        $input['id_status'] = $input['id_status'] == 'on' ? 4 : 5;
        
        
        try
        {
            $employee->update($input);
        }
        catch(Exception $e)
        {
            return false;
        }

        return view("backend.employees.index");

    
    }

    public function showModel($request_code=null)
    {
        if($request_code){
            return Employees::selectRaw('employee_name, employee_sector, id_employee')
                            ->where('employee_code', $request_code)
                            ->get()->first();
        }else{
            return FALSE;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_employee)
    {
        $employee = Employees::find($id_employee);
        try
        {
            $employee->delete();
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}
