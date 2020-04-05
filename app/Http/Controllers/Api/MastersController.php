<?php

namespace App\Http\Controllers\Api;

use App\Allowance;
use App\DDO;
use App\Deduction;
use App\Department;
use App\Designation;
use App\GpfGroup;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiMasters as MastersResource;
use App\PayMatrix;
use App\Treasury;
use Illuminate\Http\Request;

class MastersController extends Controller
{
    /* Allowances */
    public function allow_index(){
        $allow = Allowance::paginate(10);
        return MastersResource::collection($allow);
    }

    public function allow_store(Request $request)
    {
        $allow = $request->isMethod('put') ? Allowance::findOrFail($request->id) : new Allowance();

        $allow->id = $request->input('id');
        $allow->allow_code = $request->input('allow_code');
        $allow->allow_name = $request->input('allow_name');

        if($allow->save()){
            return new MastersResource($allow);
        }
    }

    public function allow_show($id)
    {
        $allow = Allowance::findOrFail($id);
        return new MastersResource($allow);
    }

    public function allow_destroy($id)
    {
        $allow = Allowance::findOrFail($id);
        if($allow->delete()) {
            return new MastersResource($allow);
        }
    }

    // End Allowances

    // DDO

    public function ddo_index(){
        $ddo = DDO::paginate(10);
        return MastersResource::collection($ddo);
    }

    public function ddo_store(Request $request)
    {
        $ddo = $request->isMethod('put') ? DDO::findOrFail($request->id) : new DDO();

        $ddo->id = $request->input('id');
        $ddo->ddo_code = $request->input('ddo_code');
        $ddo->ddo_desc = $request->input('ddo_desc');
        $ddo->dept_code = $request->input('dept_code');
        $ddo->ddo_name = $request->input('ddo_name');
        $ddo->treasury_code = $request->input('treasury_code');
        $ddo->bank_code = $request->input('bank_code');

        if($ddo->save()){
            return new MastersResource($ddo);
        }
    }

    public function ddo_show($id)
    {
        $ddo = DDO::findOrFail($id);
        return new MastersResource($ddo);
    }

    public function ddo_destroy($id)
    {
        $ddo = DDO::findOrFail($id);
        if($ddo->delete()) {
            return new MastersResource($ddo);
        }
    }

    //End DDO

    // Deductions

    public function deduction_index(){
        $ddtn = Deduction::paginate(10);
        return MastersResource::collection($ddtn);
    }

    public function deduction_store(Request $request)
    {
        $ddtn = $request->isMethod('put') ? Deduction::findOrFail($request->id) : new Deduction();

        $ddtn->id = $request->input('id');
        $ddtn->deduction_code = $request->input('ddn_code');
        $ddtn->deduction_name = $request->input('ddn_name');
        $ddtn->grant_no = $request->input('grant_no');
        $ddtn->account_head = $request->input('ac_head');
        $ddtn->category = $request->input('category');

        if($ddtn->save()){
            return new MastersResource($ddtn);
        }
    }

    public function deduction_show($id)
    {
        $ddtn = Deduction::findOrFail($id);
        return new MastersResource($ddtn);
    }

    public function deduction_destroy($id)
    {
        $ddtn = Deduction::findOrFail($id);
        if($ddtn->delete()) {
            return new MastersResource($ddtn);
        }
    }

    // End Deductions

    // Departments

    public function dept_index(){
        $dept = Department::paginate(10);
        return MastersResource::collection($dept);
    }

    public function dept_store(Request $request)
    {
        $dept = $request->isMethod('put') ? Department::findOrFail($request->id) : new Department();

        $dept->id = $request->input('id');
        $dept->dept_code = $request->input('dept_code');
        $dept->dept_name = $request->input('dept_name');

        if($dept->save()){
            return new MastersResource($dept);
        }
    }

    public function dept_show($id)
    {
        $dept = Department::findOrFail($id);
        return new MastersResource($dept);
    }

    public function dept_destroy($id)
    {
        $dept = Department::findOrFail($id);
        if($dept->delete()) {
            return new MastersResource($dept);
        }
    }

    // End Departments

    // Designations

    public function desgn_index(){
        $desgn = Designation::paginate(10);
        return MastersResource::collection($desgn);
    }

    public function desgn_store(Request $request)
    {
        $desgn = $request->isMethod('put') ? Designation::findOrFail($request->id) : new Designation();

        $desgn->id = $request->input('id');
        $desgn->dept_code = $request->input('dept_code');
        $desgn->desgn_code = $request->input('desgn_code');
        $desgn->desgn_name = $request->input('desgn_name');
        $desgn->pay_level = $request->input('pay_level');

        if($desgn->save()){
            return new MastersResource($desgn);
        }
    }

    public function desgn_show($id)
    {
        $desgn = Designation::findOrFail($id);
        return new MastersResource($desgn);
    }

    public function desgn_destroy($id)
    {
        $desgn = Designation::findOrFail($id);
        if($desgn->delete()) {
            return new MastersResource($desgn);
        }
    }

    // End Designations

    public function gpf_index(){
        $gpf = GpfGroup::paginate(10);
        return MastersResource::collection($gpf);
    }

    public function gpf_store(Request $request)
    {
        $gpf = $request->isMethod('put') ? GpfGroup::findOrFail($request->id) : new GpfGroup();

        $gpf->id = $request->input('id');
        $gpf->group_id = $request->input('group_id');
        $gpf->group_name = $request->input('group_name');
        $gpf->department_id = $request->input('dept_id');

        if($gpf->save()){
            return new MastersResource($gpf);
        }
    }

    public function gpf_show($id)
    {
        $gpf = GpfGroup::findOrFail($id);
        return new MastersResource($gpf);
    }

    public function gpf_destroy($id)
    {
        $gpf = GpfGroup::findOrFail($id);
        if($gpf->delete()) {
            return new MastersResource($gpf);
        }
    }

    public function matrix_index(){
        $mtx = PayMatrix::paginate(10);
        return MastersResource::collection($mtx);
    }

    public function matrix_store(Request $request)
    {
        $mtx = $request->isMethod('put') ? PayMatrix::findOrFail($request->id) : new PayMatrix();

        $mtx->id = $request->input('id');
        $mtx->pay_level = $request->input('pay_level');
        $mtx->pay_index = $request->input('pay_index');
        $mtx->basic_pay = $request->input('basic_pay');

        if($mtx->save()){
            return new MastersResource($mtx);
        }
    }

    public function matrix_show($id)
    {
        $mtx = PayMatrix::findOrFail($id);
        return new MastersResource($mtx);
    }

    public function matrix_destroy($id)
    {
        $mtx = PayMatrix::findOrFail($id);
        if($mtx->delete()) {
            return new MastersResource($mtx);
        }
    }

    public function treasury_index(){
        $try = Treasury::paginate(10);
        return MastersResource::collection($try);
    }

    public function treasury_store(Request $request)
    {
        $try = $request->isMethod('put') ? Treasury::findOrFail($request->id) : new Treasury();

        $try->id = $request->input('id');
        $try->treasury_code = $request->input('treasury_code');
        $try->treasury_name = $request->input('treasury_name');
        $try->address = $request->input('address');

        if($try->save()){
            return new MastersResource($try);
        }
    }

    public function treasury_show($id)
    {
        $try = Treasury::findOrFail($id);
        return new MastersResource($try);
    }

    public function treasury_destroy($id)
    {
        $try = Treasury::findOrFail($id);
        if($try->delete()) {
            return new MastersResource($try);
        }
    }


}
