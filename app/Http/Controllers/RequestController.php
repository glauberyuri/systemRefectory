<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\Employees;
use App\Models\Types;
use App\Models\Sector;
use App\Models\Config;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

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
        $sectors = Sector::all();
        $config = Config::find(1);
        // date_default_timezone_set('America/Sao_Paulo');
    
        if( date('H:i') >= date('H:i', strtotime($config['config_ini_lunch'])) && date('H:i') <=  date('H:i', strtotime($config['config_end_lunch']))){
            
            return view('frontend.request', compact('types', 'config','sectors'));
        }
        elseif(date('H:i') >= date('H:i', strtotime($config['config_ini_dinner'])) && date('H:i') <=  date('H:i', strtotime($config['config_end_dinner']))){

            return view('frontend.request', compact('types', 'config', 'sectors'));

        }
        // puxar os dados necessarios para retornar junta da tela de requisição
        $erro = 'Você não pode realizar solicitações agora';

        return view('frontend.request', compact('types', 'config','erro','sectors'));

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

    public function Transfer(Request $request){

        $input = $request->all();

        $request = Requests::find($input['id_request']);

        $request->request_status = 4;

        $request->save();

        Requests::create([

            'id_employee' => $input['id_employee'],
            'id_type' => $request['id_type'],
            'id_sector' => $request['id_sector'],
            'request_date' => $request['request_date'],
            'request_status' => 2,
            'request_value' => $request['request_value'],
            'is_dinner' => $request['is_dinner'],
            

        ]);

        return true;

    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $config = Config::find(1)->toArray();
        $is_dinner = 0;
        $is_lunch = 0;


        if($input['type_select'] == 0 or  $input['sector_select'] == 0)
        {
            return redirect('/')->with('warning', 'Preencha todos os campos para solicitar');
        }

        $Requests = array(
            'id_employee' => $input['model-request-id_employee'],
            'id_type' => $input['type_select'],
            'id_sector' => $input['sector_select'],
            'request_date' => $input['model-request-date'],
            'request_status' => $input['model-request-status'],
            'request_value' => $input['model-request-value'],
            'is_dinner' => 0
        );
        if( date('H:i') >= date('H:i', strtotime($config['config_ini_dinner'])) && date('H:i') <=  date('H:i', strtotime($config['config_end_dinner']))){
            $Requests['is_dinner'] = 1; 
            $is_dinner = 1;
        }

        if( date('H:i') >= date('H:i', strtotime($config['config_ini_lunch'])) && date('H:i') <=  date('H:i', strtotime($config['config_end_lunch']))){
            $Requests['is_dinner'] = 0; 
            $is_lunch = 1;
        }

        if(empty($is_dinner) && empty($is_lunch)){
            return redirect('/');
        }
    

        try {
            $request = Requests::create($Requests);

            return redirect('/')->with(array(
                'success'=> 'Refeição solicitada com sucesso',
                'id_request' => $request->id_request,
                'data_request' => $request->created_at,
                'data_day' => $request->request_date

            ));

        }catch(Exception $e){
            $code = $e->errorInfo[1];
            $message = $code == 1062 ? 'Refeição já foi solicitada!' : $e->errorInfo[2];
           
            
            
            return redirect('/')->with('warning', $message);
        }

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

        $requesition = Requests::selectRaw("id_request, request_status,is_dinner, emp.employee_sector, emp.employee_code, emp.employee_name, tp.type_description,sec.sector_description")
                            ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                            ->leftJoin('sectors as sec', 'requests.id_sector', '=', 'sec.id_sector' )
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


        $requestDay = Requests::selectRaw("id_request,request_date, request_status, is_dinner, emp.employee_sector, emp.employee_code, emp.employee_name, tp.type_description,sec.sector_description")
                                ->leftJoin('employees as emp', 'requests.id_employee', '=', 'emp.id_employee' )
                                ->leftJoin('sectors as sec', 'requests.id_sector', '=', 'sec.id_sector' )
                                ->leftJoin('types as tp', 'requests.id_type', '=', 'tp.id_type')
                                ->whereRaw(
                                                "(request_date BETWEEN '{$dataI}' AND '{$dataF}')"
                                          )
                                ->orderByRaw('request_status asc')
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
            $request->update(['request_status' => '3']);
            
        }
        catch(Exception $e){
            return false;
        }

            return view("backend.requests.index");
    }

    public function RequestStatusApprove(Request $request, $id_request){
        $request = Requests::find($id_request);


        try{

            $request->update(['request_status' => '2']);
            
        }
        catch(Exception $e){
            return false;
        }

            return view("backend.requests.index");
    }

    public function employeeReports(){

        return view("backend.requests.employeeMonth");

    }

    public function monthReports(){

        return view("backend.requests.Month");

    }
    public function cancelForm(){

        return view("frontend.cancel_request");

    }
    
    public function extract(){

        return view("frontend.extractRequest");

    }

    public function cancelRequest(Request $request)
    {
        $input = $request->all();
        
        $employee = Employees::where('employee_code', $input['request_code'])->first();

        ( isset($employee->id_employee))? $Request = Requests::where('id_employee', $employee->id_employee)->where('request_status', 1)->first() : '' ;
        if(isset($Request->request_status) && $Request->request_status === 1){
            try
            {
                $Request->delete();
            }
            catch(Exception $e)
            {
                return false;
            }
        }else{
           (isset($employee->employee_name))? $error ='Não existem solicitação em aberto para '.$employee->employee_name.' que possam ser canceladas': $error ='Matricula inválida';
           return redirect('/')->with('error', $error);
        }
        return redirect('/')->with('success', 'Solicitação de '.$employee->employee_name.' cancelada com sucesso');
    }
    


}
