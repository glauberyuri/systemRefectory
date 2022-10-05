<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __contruct() {
        
    }

    public function index(Request $request)
    {
        return view('backend.users.index');
    }

    public function list(Request $request)
    {
        $user = User::selectRaw("name, email, id")->get()->toArray();

        $table = [
        "draw" => $request->input('draw'),
        "recordsTotal" => count($user),
        "recordsFiltered" => count($user),
        'data' => $user,
        ];
        
        return $table;
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        try
        {
            $user->delete();
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
    
}
