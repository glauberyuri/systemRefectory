<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\Employees;
use App\Models\Types;
use App\Models\Config;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pegar todos os tipos de refeições
        $types = Types::all();
        $config = Config::find(1);
        
        // puxar os dados necessarios para retornar junta da tela de requisição
        return view('frontend.request', compact('types', 'config'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Todos dados do formulario
        $input = $request->all();

        Requests::create([
            'id_employee' => $input['model-request-id_employee'],
            'id_type' => $input['type_select'],
            'request_date' => $input['model-request-date'],
            'request_status' => $input['model-request-status'],
            'request_value' => $input['model-request-value'],
        ]);

        return redirect()->route('refectory_request.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      return view('backend.requests.index');
    }


    public function list(Request $request)
    {
        $requesition = Requests::selectRaw("id_request, request_status, emp.employee_sector, st.id_status, emp.employee_code, emp.employee_name, tp.type_description")
                            ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                            ->leftJoin('status as st', 'requests.id_status', '=', 'st.id_status' )
                            ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                            ->get()->toArray();

        $table = [
        "draw" => $request->input('draw'),
        "recordsTotal" => count($requesition),
        "recordsFiltered" => count($requesition),
        'data' => $requesition,
        ];
        
        return $table;
    }
        /**
         * 
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
    public function requestsOfDay(){
        return view('backend.requests.requestOfDay');
    }

    public function filterRequest(){

        $tipo='day'; //via GET
        $dataI= date('Y-m-d 00:00:00');
        $dataF= date('Y-m-d 23:59:59');
        $m='m'; //ou via post ex: 02, 03

        switch($tipo){
            case 'week':
                $dataI= (new Carbon)->subDays(7)->startOfDay()->toDateString() .' 00:00:00';  //calcular ultimos 7 dias
                $dataF= (new Carbon)->now()->endOfDay()->toDateString() . ' 23:59:59';
            break;
            case 'mouth': 
                $dataI= date('Y-'.$m.'-01 00:00:00');
                $dataF= date('Y-'.$m.'-31 23:59:59');
            break;
        }
       // echo $dataI.' | '.$dataF;exit;


    }

    public function ListRequestsOfDay(Request $request){
        
        $dataI= date('Y-m-d 00:00:00');
        $dataF= date('Y-m-d 23:59:59');


        $requestDay = Requests::selectRaw("id_request,request_date, st.request_status, emp.employee_sector, emp.employee_code, emp.employee_name, tp.type_description")
                                ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                                ->leftJoin('status as st', 'requests.id_status', '=', 'st.id_status' )
                                ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                                ->whereRaw(
                                                "(request_date BETWEEN '{$dataI}' AND '{$dataF}')"
                                          )
                                ->where('request_status', '1')
                                ->get()->toArray();

        $table = [
            "draw" => $request->input('draw'),
            "recordsTotal" => count($requestDay),
            "recordsFiltered" => count($requestDay),
            'data' => $requestDay,
            ];
            
            return $table;

    }

    public function RequestStatusDelete(Request $request, $id_request){

        $request = Requests::find($id_request);


        try{
            $request->update(['id_status' => '5']);
            
        }
        catch(Exception $e){
            return false;
        }

            return view("backend.requests.index");
    }

    public function RequestStatusApprove(Request $request, $id_request){

        $request = Requests::find($id_request);


        try{

            $request->update(['id_status' => '4']);
            
        }
        catch(Exception $e){
            return false;
        }

            return view("backend.requests.index");
    }


}
