<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('admin/departments', 'Api\MastersController@dept_index');
Route::get('admin/department/{id}', 'Api\MastersController@dept_show');
Route::post('admin/department', 'Api\MastersController@dept_store');
Route::put('admin/department', 'Api\MastersController@dept_store');
Route::delete('admin/department/{id}', 'Api\MastersController@dept_destroy');
Route::get('admin/allowances', 'Api\MastersController@allow_index');
Route::get('admin/allowance/{id}', 'Api\MastersController@allow_show');
Route::post('admin/allowance', 'Api\MastersController@allow_store');
Route::put('admin/allowance', 'Api\MastersController@allow_store');
Route::delete('admin/allowance/{id}', 'Api\MastersController@allow_destroy');
Route::get('admin/ddos', 'Api\MastersController@ddo_index');
Route::get('admin/ddo/{id}', 'Api\MastersController@ddo_show');
Route::post('admin/ddo', 'Api\MastersController@ddo_store');
Route::put('admin/ddo', 'Api\MastersController@ddo_store');
Route::delete('admin/ddo/{id}', 'Api\MastersController@ddo_destroy');
Route::get('admin/deductions', 'Api\MastersController@deduction_index');
Route::get('admin/deduction/{id}', 'Api\MastersController@deduction_show');
Route::post('admin/deduction', 'Api\MastersController@deduction_store');
Route::put('admin/deduction', 'Api\MastersController@deduction_store');
Route::delete('admin/deduction/{id}', 'Api\MastersController@deduction_destroy');
Route::get('admin/designations', 'Api\MastersController@desgn_index');
Route::get('admin/designation/{id}', 'Api\MastersController@desgn_show');
Route::post('admin/designation', 'Api\MastersController@desgn_store');
Route::put('admin/designation', 'Api\MastersController@desgn_store');
Route::delete('admin/designation/{id}', 'Api\MastersController@desgn_destroy');
Route::get('admin/gpf-groups', 'Api\MastersController@gpf_index');
Route::get('admin/gpf-group/{id}', 'Api\MastersController@gpf_show');
Route::post('admin/gpf-group', 'Api\MastersController@gpf_store');
Route::put('admin/gpf-group', 'Api\MastersController@gpf_store');
Route::delete('admin/gpf-group/{id}', 'Api\MastersController@gpf_destroy');
Route::get('admin/pay-matrices', 'Api\MastersController@matrix_index');
Route::get('admin/pay-matrix/{id}', 'Api\MastersController@matrix_show');
Route::post('admin/pay-matrix', 'Api\MastersController@matrix_store');
Route::put('admin/pay-matrix', 'Api\MastersController@matrix_store');
Route::delete('admin/pay-matrix/{id}', 'Api\MastersController@matrix_destroy');
Route::get('admin/treasuries', 'Api\MastersController@treasury_index');
Route::get('admin/treasury/{id}', 'Api\MastersController@treasury_show');
Route::post('admin/treasury', 'Api\MastersController@treasury_store');
Route::put('admin/treasury', 'Api\MastersController@treasury_store');
Route::delete('admin/treasury/{id}', 'Api\MastersController@treasury_destroy');
