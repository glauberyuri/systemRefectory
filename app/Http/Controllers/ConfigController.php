<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Config::find(1);
        
        return view('backend.config.create', compact('config'));
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

        if($input['config_ini_lunch'] >= $input['config_ini_dinner'] || $input['config_end_lunch'] >= $input['config_ini_dinner']){
            abort(400, 'Ação não permitida.');
        }
        elseif($input['config_ini_lunch'] >= $input['config_end_lunch']){
            abort(400, 'Ação não permitida.');
        }
        elseif($input['config_ini_dinner'] >= $input['config_end_dinner']){
            abort(400, 'Ação não permitida.');
        }
        try {

            $config = Config::updateOrCreate(
                [
                    'id_config' => 1 
                ],
                [
                    'config_value' => $input['config_value'],
                    'config_ini_lunch' => $input['config_ini_lunch'],
                    'config_end_lunch' => $input['config_end_lunch'],
                    'config_ini_dinner' => $input['config_ini_dinner'],
                    'config_end_dinner' => $input['config_end_dinner']
                ]);

        }catch(Exception $e)

        {
            return false;
        }

        return redirect()->route('refectory_config.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
