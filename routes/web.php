<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*RequestControllerrefectory_employee/showModel
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(["verify" => true]);


Route::get("/",                                                                                 ["as" => "refectory_request.index",   "uses" => "RequestController@index"]);
Route::get("/cancel",                                                                           ["as" => "refectory_request.cancel_form",   "uses" => "RequestController@cancelForm"]);
Route::get("/extract",                                                                          ["as" => "refectory_request.extract",   "uses" => "RequestController@extract"]);
Route::get("refectory_employee/showModel/{request_code}",                                       ["as" => "refectory_employee.showModel", "uses" => "EmployeeController@showModel"]);
Route::post("refectory_request/store",                                                          ["as" => "refectory_request.store",   "uses" => "RequestController@store"]);
Route::post("refectory_request/cancelRequest",                                                  ["as" => "refectory_request.cancelRequest",   "uses" => "RequestController@cancelRequest"]);
Route::post("refectory_reports/employeepdf",                                                    ["as" => "refectory_reports.employeeReportsPDF", "uses" =>  "EmployeeController@employeeReportsPDF"]);

Route::group(["middleware" => "auth"], function () {


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name="home";

// Usuarios
Route::group(["prefix" => "users"], function(){
    Route::get("/",                                                               ["as" => "users.index", "uses" => "UserController@index"]);
    Route::get("/list",                                                           ["as" => "users_list.list", "uses" => "UserController@list"]);
    Route::delete("/users_delete/{id}",                                           ["as" => "users.delete_user", "uses" => "UserController@destroy"]);
    Route::get("/users_edit/{id}",                                                ["as" => "users.edit_user", "uses" => "UserController@edit"]);
    Route::match(["put", "patch"],"/users_edit_update/{id}",                      ["as" => "users.edit_update_user", "uses" => "UserController@update"]);

});

// Funcionarios
Route::group(["prefix" => "refectory_employee"], function(){
    Route::get("/",                                                               ["as" => "refectory_employee.index", "uses" => "EmployeeController@index"]);
    Route::get("/list",                                                           ["as" => "refectory_employee.list", "uses" => "EmployeeController@list"]);
    Route::post("/store",                                                         ["as" => "refectory_employee.store", "uses" => "EmployeeController@store"]);
    Route::delete("/employee_delete/{id_employee}",                               ["as" => "refectory_employee.delete_employee", "uses" => "EmployeeController@destroy"]);
    Route::get("/employee_edit/{id_employee}",                                    ["as" => "refectory_employee.edit_employee", "uses" => "EmployeeController@edit"]);
    Route::match(["put", "patch"],"/employee_edit_update/{id_employee}",          ["as" => "refectory_employee.edit_update_employee", "uses" => "EmployeeController@update"]);
    Route::get("/employee",                                                       ["as" => "refectory_employee.findEmployee", "uses" => "EmployeeController@findEmployee"]);
    Route::get("/getEmployees",                                                   ["as" => "refectory_employee.getEmployees", "uses" => "EmployeeController@getEmployees"]);
});
// Solicitação de refeições
Route::group(["prefix" => "refectory_request"], function () {
    Route::get("/listRequest",                                                     ["as" => "refectory_request.listRequest", "uses" => "RequestController@listRequest"]);
    Route::get("/showrequest",                                                     ["as" => "refectory_request.showrequest", "uses" => "RequestController@show"]);
    Route::get("/list",                                                            ["as" => "refectory_request.list", "uses" => "RequestController@list"]);
    Route::get("/requestday",                                                      ["as" => "refectory_request.requestsOfDay", "uses" => "RequestController@requestsOfDay"]);
    Route::get("/listRequestDay",                                                  ["as" => "refectory_request.listRequestDay", "uses" => "RequestController@ListRequestsOfDay"]);
    Route::match(["put", "patch"],"/request_status_delete/{id_request}",           ["as" => "refectory_request.request_status_delete", "uses" => "RequestController@RequestStatusDelete"]);
    Route::match(["put", "patch"],"/request_status_approve/{id_request}",          ["as" => "refectory_request.request_status_approve", "uses" => "RequestController@RequestStatusApprove"]);
    Route::post("/transfer",                                                       ["as" => "refectory_request.trasnfer", "uses" => "RequestController@Transfer"]);
});

// Tipos
Route::group(["prefix" => "types"], function(){
    Route::get("/",                                                               ["as" => "types.index", "uses" => "TypesController@index"]);
    Route::get("/list",                                                           ["as" => "types.list", "uses" => "TypesController@list"]);
    Route::post("/store",                                                         ["as" => "types.store", "uses" => "TypesController@store"]);
    Route::delete("/types_delete/{id}",                                           ["as" => "types.delete", "uses" => "TypesController@destroy"]);
    Route::get("/types_edit/{id}",                                                ["as" => "types.edit", "uses" => "TypesController@edit"]);
    Route::match(["put", "patch"],"/types_edit_update/{id}",                      ["as" => "types.edit_update", "uses" => "TypesController@update"]);

});

// Setores
Route::group(["prefix" => "sectors"], function(){
    Route::get("/",                                                                 ["as" => "sectors.index", "uses" => "SectorController@index"]);
    Route::get("/list",                                                             ["as" => "sectors.list", "uses" => "SectorController@list"]);
    Route::post("/store",                                                           ["as" => "sectors.store", "uses" => "SectorController@store"]);
    Route::delete("/sectors_delete/{id_sector}",                                    ["as" => "sectors.delete", "uses" => "SectorController@destroy"]);
    Route::get("/sectors_edit/{id_sector}",                                         ["as" => "sectors.edit", "uses" => "SectorController@edit"]);
    Route::match(["put", "patch"],"/sectors_edit_update/{id_sector}",               ["as" => "sectors.edit_update", "uses" => "SectorController@update"]);

});

// Configuração
Route::group(["prefix" => "refectory_config"], function () {
    Route::get("/",                                                                 ["as" => "refectory_config.index", "uses" =>  "ConfigController@index"]);
    Route::post("/store",                                                           ["as" => "refectory_config.store",   "uses" => "ConfigController@store"]);
});

//Relatórios

Route::group(["prefix" => "refectory_reports"], function () {
    Route::get("/",                                                                ["as" => "refectory_reports.index", "uses" =>  "ConfigController@index"]);
    Route::get("/employeeReports",                                                 ["as" => "refectory_reports.employeeReports", "uses" =>  "RequestController@employeeReports"]);
    Route::get("/monthReports",                                                    ["as" => "refectory_reports.monthReports", "uses" =>  "RequestController@monthReports"]);
    Route::post("/momthpdf",                                                       ["as" => "refectory_reports.monthReportsPDF", "uses" =>  "EmployeeController@monthReportsPDF"]);
    Route::get("/requestsToDay",                                                   ["as" => "refectory_reports.requestsToDay", "uses" =>  "EmployeeController@requestsToDay"]);
    Route::post("/store",                                                          ["as" => "refectory_reports.store",   "uses" => "ConfigController@store"]);
});


});