<?php

namespace App\Http\Controllers;

use App\Allowance;
use App\DDO;
use App\Deduction;
use App\Department;
use App\Designation;
use App\GpfGroup;
use App\PayMatrix;
use App\Treasury;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Yajra\DataTables\DataTables;
use DB;
use Session;

class MastersController extends Controller
{
    public function dept_index(Request $request){
        if($request->ajax()) {
            $data = Department::all();
            //dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id . '"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('masters.departments');
    }

    public function dept_store(Request $request){
        $dept = Department::updateOrCreate(
            ['id' => $request->dept_id],
            ['dept_code' => $request->dept_code, 'dept_name' => $request->dept_name]
        );
        return Response::json($dept);
    }

    public function dept_edit($id){
        $dept = Department::find($id);
        return Response::json($dept);
    }

    public function dept_destroy($id){
        $dept = Department::where('id',$id)->delete();
        return Response::json($dept);
    }

    public function getDepts(){
        return Response::json(Department::all());
        exit;
    }

    public function getDept($id){
        $dept = Department::where('dept_code', $id)->get();
        return Response::json($dept);
    }

    public function treasury_index(Request $request){
        if($request->ajax()) {
            $data = Treasury::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('masters.treasuries');
    }

    public function treasury_store(Request $request){
        $treasury = Treasury::updateOrCreate(
            ['id' => $request->treasury_id],
            [
                'treasury_code' => $request->treasury_code,
                'treasury_name' => $request->treasury_name,
                'address' => $request->address,
            ]
        );
        return Response::json($treasury);
    }

    public function treasury_edit($id){
        $try = Treasury::find($id);
        return Response::json($try);
    }

    public function treasury_destroy($id){
        $try = Treasury::where('id', $id)->delete();
        return Response::json($try);
    }

    public function allow_index(Request $request){
        if($request->ajax()) {
            $data = Allowance::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('masters.allowances');
    }

    public function allow_store(Request $request){
        $all = Allowance::updateOrCreate(
            ['id' => $request->allow_id],
            [
                'allow_code' => $request->allow_code,
                'allow_name' => $request->allow_name,
            ]
        );
        return Response::json($all);
    }

    public function allow_edit($id){
        $all = Allowance::find($id);
        return Response::json($all);
    }

    public function allow_destroy($id){
        $all = Allowance::where('id', $id)->delete();
        return Response::json($all);
    }

    public function gpf_index(Request $request){
        if($request->ajax()) {
            $data = GpfGroup::all();
//            $data = DB::table('gpf_groups')
//                -> leftJoin('departments', 'departments.id', '=', 'gpf_groups.department_id')
//                -> select('gpf_groups.id', 'gpf_groups.group_id', 'gpf_groups.group_name', 'departments.dept_name')
//                -> get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $dept = Department::all();
        return view('masters.gpf-groups') -> with('dept', $dept);
    }

    public function gpf_store(Request $request){
        $gpf = GpfGroup::updateOrCreate(
            ['id' => $request->id],
            [
                'group_id' => $request->gpf_id,
                'group_name' => $request->gpf_name,
                'department_id' => $request->dept_id,
            ]
        );
        return Response::json($gpf);
    }

    public function gpf_edit($id){
        $gpf = GpfGroup::find($id);
        return Response::json($gpf);
    }

    public function gpf_destroy($id){
        $gpf = GpfGroup::where('id', $id)->delete();
        return Response::json($gpf);
    }

    public function matrix_index(Request $request){
        if($request->ajax()) {
            $data = PayMatrix::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('masters.7-pay-matrix');
    }

    public function matrix_store(Request $request){
        $mtx = PayMatrix::updateOrCreate(
            ['id' => $request->id],
            [
                'pay_level' => $request->pay_level,
                'pay_index' => $request->pay_index,
                'basic_pay' => $request->basic_pay,
            ]
        );
        return Response::json($mtx);
    }

    public function matrix_edit($id){
        $mtx = PayMatrix::find($id);
        return Response::json($mtx);
    }

    public function matrix_destroy($id){
        $mtx = PayMatrix::where('id', $id)->delete();
        return Response::json($mtx);
    }

    public function deduction_index(Request $request){
        if($request->ajax()) {
            $data = Deduction::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('masters.deductions');
    }

    public function deduction_store(Request $request){
        $ddcn = Deduction::updateOrCreate(
            ['id' => $request->id],
            [
                'deduction_code' => $request->deduction_code,
                'deduction_name' => $request->deduction_name,
                'grant_no' => $request->grant_no,
                'account_head' => $request->account_head,
                'category' => $request->category,
            ]
        );
        return Response::json($ddcn);
    }

    public function deduction_edit($id){
        $ddcn = Deduction::find($id);
        return Response::json($ddcn);
    }

    public function deduction_destroy($id){
        $ddcn = Deduction::where('id', $id)->delete();
        return Response::json($ddcn);
    }

    public function desgn_index(Request $request){
        if($request->ajax()) {
            $data = Designation::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
//                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="' . route('designation.edit', $data->id) . '" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  ><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $dept = Department::all();
        return view('masters.designations') -> with ('dept', $dept);
    }

    public function desgn_store(Request $request){
        $desgn = Designation::updateOrCreate(
            ['id' => $request->id],
            [
                'dept_code' => $request->dept_code,
                'desgn_code' => $request->desgn_code,
                'desgn_name' => $request->desgn_name,
                'pay_level' => $request->pay_level,
            ]
        );
        return Response::json($desgn);
    }

    public function desgn_edit($id){
//        $desgn = Designation::find($id);
//        return Response::json($desgn);
        $dept = Department::all();
        $desgn = Designation::find($id);
        return view('masters.desgn-edit')
            -> with ('dept', $dept)
            -> with ('desgn', $desgn);
    }

    public function desgn_update(Request $request, $id){
        $this->validate($request, [
            'dept_code' => 'required',
            'desgn_code' => 'required',
            'desgn_name' => 'required'
            ]);
        $desgn = Designation::find($id);
        $desgn->dept_code = $request->dept_code;
        $desgn->desgn_code = $request->desgn_code;
        $desgn->desgn_name = $request->desgn_name;
        $desgn->pay_level = $request->pay_level;
        $desgn->save();
        Session::flash('success', 'Designation updated successfully');
        return redirect('admin/designations');
    }

    public function desgn_destroy($id){
        $desgn = Designation::where('id', $id)->delete();
        return Response::json($desgn);
    }

    public function ddo_index(Request $request){
        if($request->ajax()) {
            $data = DDO::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) {
                    $btn = '<div class="btn-group">';
//                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"  data-id="' . $data->id . '"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="' . route('ddo.edit', $data->id) . '" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.'<a href="javascript:void(0);" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-danger delete" data-id="' . $data->id .'"><i class="fas fa-trash"></i></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $dept = Department::all();
        $tries = Treasury::all();
        return view('masters.ddos')
            -> with ('dept', $dept)
            -> with ('tries', $tries);
    }

    public function ddo_store(Request $request){
        $this->validate($request, [
                'ddo_code' => 'required',
                'ddo_desc' => 'required',
                'treasury_code' => 'required'
            ]);
        $ddo = DDO::updateOrCreate(
            ['id' => $request->id],
            [
                'ddo_code' => $request->ddo_code,
                'ddo_desc' => $request->ddo_desc,
                'dept_code' => $request->dept_code,
                'ddo_name' => $request->ddo_name,
                'treasury_code' => $request->treasury_code,
                'bank_code' => $request->bank_code,
            ]
        );
        return Response::json($ddo);
    }

    public function ddo_edit($id){
//        $ddo = DDO::find($id);
//        return Response::json($ddo);
        $depts = Department::all();
        $tries = Treasury::all();
        $ddo = DDO::find($id);

        //dd($ddo);
        return view('masters.ddos-edit')
            -> with ('dept', $depts)
            -> with ('tries', $tries)
            -> with ('ddo', $ddo);
    }

    public function ddo_update(Request $request, $id){
        //dd($request->all());
        $this->validate($request, [
            'ddo_code' => 'required',
            'ddo_desc' => 'required',
            'treasury_code' => 'required'
        ]);
        $ddo = DDO::find($id);
        $ddo->ddo_code = $request->ddo_code;
        $ddo->ddo_desc = $request->ddo_desc;
        $ddo->dept_code = $request->dept_code;
        $ddo->ddo_name = $request->ddo_name;
        $ddo->treasury_code = $request->treasury_code;
        $ddo->bank_code = $request->bank_code;
        $ddo->save();
        Session::flash('success', 'DDO Detail updated successfully');
        return redirect('admin/ddos');
    }

    public function ddo_destroy($id){
        $ddo = DDO::where('id', $id)->delete();
        return Response::json($ddo);
    }
}
