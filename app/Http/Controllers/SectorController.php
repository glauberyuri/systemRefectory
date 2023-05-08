<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.sectors.index');
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
            $sector = Sector::create($input);
        }
        catch(Exception $e)
        {
            return false;
        }

        return view("backend.sectors.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $sector = Sector::selectRaw('id_sector, sector_description')->get()->toArray();
        $table = [
 
             "draw" => $request->input('draw'),
             "recordsTotal" => count($sector),
             "recordsFiltered" => count($sector),
             'data' => $sector,
 
         ];
         
         return $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sector)
    {
        if($id_sector){
            return Sector::selectRaw('sector_description, id_sector')
                            ->where('id_sector', $id_sector)
                            ->get()->first();
        }else{
            return FALSE;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_sector)
    {
        $sector = Sector::find($id_sector);
        
        $input = $request->all();
        
        try
        {
            $sector->update($input);
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sector)
    {
        $sector = Sector::find($id_sector);

        try
        {
            $sector->delete();
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}
