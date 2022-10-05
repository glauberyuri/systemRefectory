<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Requests;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        (isset($input['employee_status']))? $input['employee_status'] = 1 : $input['employee_status'] = 0;

        (isset($input['is_doctor']))? $input['is_doctor'] = 1 : $input['is_doctor'] = 0;

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

        $employees = Employees::select("*")
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
            return Employees::select('*')
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
    public function update(Request $request, $id_employee)
    {
        // 

        $employee = Employees::find($id_employee);
        
        $input = $request->all();
        (isset($input['employee_status']))? $input['employee_status'] = 1 : $input['employee_status'] = 0;

        (isset($input['is_doctor']))? $input['is_doctor'] = 1 : $input['is_doctor'] = 0;
        
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
                            ->where('employee_status', 1)
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

    public function findEmployee(Request $request){


        $input = $request->all();
        $employee = Employees::where('employee_code', $input['id_employee'])->where('employee_status', 1)->first();

        return $employee;
    }

    public function getEmployees(Request $request){

        $search = $request->has('q') ? $request->q : '';

        $employees = Employees::selectRaw("id_employee, employee_name, employee_status ")
                ->where('employee_status', 1)
                ->whereRaw('employee_name like "%'.$search.'%"')
                ->get();


        return $employees;

    }

    public function employeeReportsPDF(Request $request){

        $input = $request->all();
        $total = 0;
        
        if(isset($input['id_employee']))
        {
            $employee = Requests::selectRaw("requests.id_request,date_format(requests.request_date, '%d/%m/%Y  %H:%i:%s') as request_date_formated,date_format(requests.updated_at, '%d/%m/%Y  %H:%i:%s') as updated_date_formated, requests.request_status, requests.request_value, emp.employee_sector, emp.employee_code, emp.employee_name, tp.type_description")
                                ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                                ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                                ->whereIn('requests.request_status', [2,3])
                                ->where('emp.id_employee', $input['id_employee'])
                                ->whereRaw("date_format(requests.request_date,'%Y-%m') =". "'".date('Y-m', strtotime($input['reports_month']))."'")
                                ->get()
                                ->toArray();

            $total = Requests::selectRaw('SUM(requests.request_value) as total')
                            ->where('id_employee', $input['id_employee'])
                            ->whereIn('requests.request_status', [2,3])
                            ->whereRaw("date_format(requests.request_date,'%Y-%m') =". "'".date('Y-m', strtotime($input['reports_month']))."'")
                            ->first();

        }else{

            $employee = Requests::selectRaw("requests.id_request,date_format(requests.request_date, '%d/%m/%Y  %H:%i:%s') as request_date_formated,date_format(requests.updated_at, '%d/%m/%Y  %H:%i:%s') as updated_date_formated, requests.request_status, requests.request_value,emp.id_employee, emp.employee_sector, emp.employee_code, emp.employee_name, tp.type_description")
                                ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                                ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                                ->whereIn('requests.request_status', [2,3])
                                ->where('emp.employee_code', $input['request_code'])
                                ->get()
                                ->toArray();
                                
                if(isset($employee[0]['id_employee'])){
                    $total = Requests::selectRaw('SUM(requests.request_value) as total')
                    ->where('id_employee', $employee[0]['id_employee'])
                    ->whereIn('requests.request_status', [2,3])
                    ->first();
                }
                
                        
        }
        return  view('backend.requests.reportsEmployee', compact('employee','total'));
    }

    public function monthReportsPDF(Request $request){
        $input = $request->all();
        $requests = Requests::selectRaw("emp.employee_code,emp.employee_name,emp.employee_sector,COUNT(requests.request_value) as qtd, SUM(requests.request_value) as request_value")
                            ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                            ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                            ->whereIn('requests.request_status', [2,3])
                            ->whereRaw("date_format(requests.request_date,'%Y-%m') =". "'".date('Y-m', strtotime($input['reports_month']))."'")
                            ->groupBy('emp.employee_code')
                            ->groupBy('emp.employee_name')
                            ->groupBy('emp.employee_sector')
                            ->get()
                            ->toArray();

        
        return  view('backend.requests.reportsMonth', compact('requests'));
    }

    public function requestsToDay(Request $request){
        $input = $request->all();
        $requests = Requests::selectRaw("tp.type_description, COUNT(requests.request_value) as qtd")
                            ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                            ->where('requests.request_status', 1)
                            ->whereRaw("date_format(requests.request_date,'%Y-%m-%d') =". "'".date('Y-m-d')."'")
                            ->groupBy('tp.type_description')
                            ->get()
                            ->toArray();

                            // dd($requests);
        
        return  view('backend.requests.report_today', compact('requests'));
    }
}
