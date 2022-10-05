<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    // public function __contruct() {

        
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.types.index');
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try
        {
            $type = Types::create($input);
        }
        catch(Exception $e)
        {
            return false;
        }

        return view("backend.types.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
       $type = Types::selectRaw('id_type, type_description')->get()->toArray();

       $table = [

            "draw" => $request->input('draw'),
            "recordsTotal" => count($type),
            "recordsFiltered" => count($type),
            'data' => $type,

        ];
        
        return $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function edit(Types $types, $id_type)
    {
        if($id_type){
            return Types::selectRaw('type_description, id_type')
                            ->where('id_type', $id_type)
                            ->get()->first();
        }else{
            return FALSE;
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_type)
    {
        $type = Types::find($id_type);
        
        $input = $request->all();


        try
        {
            $type->update($input);
        }
        catch(Exception $e)
        {
            return false;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Types  $types
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_type)
    {
        $type = Types::find($id_type);

        try
        {
            $type->delete();
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}
