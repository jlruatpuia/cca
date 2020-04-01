<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/departments', [
    'uses' => 'MastersController@dept_index',
    'as' => 'departments'
]);
Route::post('admin/departments/store', [
    'uses' => 'MastersController@dept_store',
    'as' => 'department.store'
]);
Route::get('admin/departments/{id}/edit', [
    'uses' => 'MastersController@dept_edit',
    'as' => 'department.edit'
]);
Route::delete('admin/departments/delete/{id}', [
    'uses' => 'MastersController@dept_destroy',
    'as' => 'department.destroy'
]);
Route::get('admin/treasuries', [
    'uses' => 'MastersController@treasury_index',
    'as' => 'treasuries'
]);
Route::post('admin/treasuries/store', [
    'uses' => 'MastersController@treasury_store',
    'as' => 'treasury.store'
]);
Route::get('admin/treasuries/{id}/edit', [
    'uses' => 'MastersController@treasury_edit',
    'as' => 'treasury.edit'
]);
Route::delete('admin/treasuries/delete/{id}', [
    'uses' => 'MastersController@treasury_destroy',
    'as' => 'treasury.destroy'
]);
Route::get('admin/allowances', [
    'uses' => 'MastersController@allow_index',
    'as' => 'allowances'
]);
Route::post('admin/allowances/store', [
    'uses' => 'MastersController@allow_store',
    'as' => 'allowance.store'
]);
Route::get('admin/allowances/{id}/edit', [
    'uses' => 'MastersController@allow_edit',
    'as' => 'allowance.edit'
]);
Route::delete('admin/allowances/delete/{id}', [
    'uses' => 'MastersController@allow_destroy',
    'as' => 'allowance.destroy'
]);
Route::get('admin/gpf-groups', [
    'uses' => 'MastersController@gpf_index',
    'as' => 'gpfs'
]);
Route::post('admin/gpf-groups/store', [
    'uses' => 'MastersController@gpf_store',
    'as' => 'gpf.store'
]);
Route::get('admin/gpf-groups/{id}/edit', [
    'uses' => 'MastersController@gpf_edit',
    'as' => 'gpf.edit'
]);
Route::delete('admin/gpf-groups/delete/{id}', [
    'uses' => 'MastersController@gpf_destroy',
    'as' => 'gpf.destroy'
]);
Route::get('admin/7-pay-matrix', [
    'uses' => 'MastersController@matrix_index',
    'as' => 'matrices'
]);
Route::post('admin/7-pay-matrix/store', [
    'uses' => 'MastersController@matrix_store',
    'as' => 'matrix.store'
]);
Route::get('admin/7-pay-matrix/{id}/edit', [
    'uses' => 'MastersController@matrix_edit',
    'as' => 'matrix.edit'
]);
Route::delete('admin/7-pay-matrix/delete/{id}', [
    'uses' => 'MastersController@matrix_destroy',
    'as' => 'matrix.destroy'
]);
Route::get('admin/deductions', [
    'uses' => 'MastersController@deduction_index',
    'as' => 'deductions'
]);
Route::post('admin/deductions/store', [
    'uses' => 'MastersController@deduction_store',
    'as' => 'deduction.store'
]);
Route::get('admin/deductions/{id}/edit', [
    'uses' => 'MastersController@deduction_edit',
    'as' => 'deduction.edit'
]);
Route::delete('admin/deductions/delete/{id}', [
    'uses' => 'MastersController@deduction_destroy',
    'as' => 'deduction.destroy'
]);
Route::get('admin/designations', [
    'uses' => 'MastersController@desgn_index',
    'as' => 'designations'
]);
Route::post('admin/designations/store', [
    'uses' => 'MastersController@desgn_store',
    'as' => 'designation.store'
]);
Route::get('admin/designations/{id}/edit', [
    'uses' => 'MastersController@desgn_edit',
    'as' => 'designation.edit'
]);
Route::delete('admin/designations/delete/{id}', [
    'uses' => 'MastersController@desgn_destroy',
    'as' => 'designation.destroy'
]);
Route::get('admin/ddos', [
    'uses' => 'MastersController@ddo_index',
    'as' => 'ddos'
]);
Route::post('admin/ddos/store', [
    'uses' => 'MastersController@ddo_store',
    'as' => 'ddo.store'
]);
Route::get('admin/ddos/{id}/edit', [
    'uses' => 'MastersController@ddo_edit',
    'as' => 'ddo.edit'
]);
Route::delete('admin/ddos/delete/{id}', [
    'uses' => 'MastersController@ddo_destroy',
    'as' => 'ddo.destroy'
]);
