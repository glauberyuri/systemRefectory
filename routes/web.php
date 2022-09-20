<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Route::get("/", function () {
//     return redirect(route("home"));
// });

 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name="home";

// Funcionarios
Route::group(["prefix" => "refectory_employee"], function(){
    Route::get("/",                                                               ["as" => "refectory_employee.index", "uses" => "EmployeeController@index"]);
    Route::get("/list",                                                           ["as" => "refectory_employee.list", "uses" => "EmployeeController@list"]);
    Route::post("/store",                                                         ["as" => "refectory_employee.store", "uses" => "EmployeeController@store"]);
    Route::get("/showModel/{request_code}",                                       ["as" => "refectory_employee.showModel", "uses" => "EmployeeController@showModel"]);
    Route::delete("/employee_delete/{id_employee}",                               ["as" => "refectory_employee.delete_employee", "uses" => "EmployeeController@destroy"]);
    Route::get("/employee_edit/{id_employee}",                                    ["as" => "refectory_request.edit_employee", "uses" => "EmployeeController@edit"]);
    Route::match(["put", "patch"],"/employee_edit_update/{id_employee}",          ["as" => "refectory_request.edit_update_employee", "uses" => "EmployeeController@update"]);

});
// Solicitação de refeições
Route::group(["prefix" => "refectory_request"], function () {
    Route::get("/",                                                                ["as" => "refectory_request.index",   "uses" => "RequestController@index"]);
    Route::post("/store",                                                          ["as" => "refectory_request.store",   "uses" => "RequestController@store"]);
    Route::get("/listRequest",                                                     ["as" => "refectory_request.listRequest", "uses" => "RequestController@listRequest"]);
    Route::get("/showrequest",                                                     ["as" => "refectory_request.showrequest", "uses" => "RequestController@show"]);
    Route::get("/list",                                                            ["as" => "refectory_request.list", "uses" => "RequestController@list"]);
    Route::get("/requestday",                                                      ["as" => "refectory_request.requestsOfDay", "uses" => "RequestController@requestsOfDay"]);
    Route::get("/listRequestDay",                                                  ["as" => "refectory_request.listRequestDay", "uses" => "RequestController@ListRequestsOfDay"]);
    Route::match(["put", "patch"],"/request_status_delete/{id_request}",           ["as" => "refectory_request.request_status_delete", "uses" => "RequestController@RequestStatusDelete"]);
    Route::match(["put", "patch"],"/request_status_approve/{id_request}",          ["as" => "refectory_request.request_status_approve", "uses" => "RequestController@RequestStatusApprove"]);

});
// Configuração
Route::group(["prefix" => "refectory_config"], function () {
    Route::get("/",                                                                 ["as" => "refectory_config.index", "uses" =>  "ConfigController@index"]);
});

