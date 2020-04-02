@extends('layouts.app')
@section('page_title')
     Edit Designations
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DESIGNATION</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item">Designations</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Designations</h3>
                </div>
                <div class="card-body">
                    <form id="ajaxForm" name="ajaxForm" action="{{ route('desgn.update', ['id' => $desgn->id]) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" id="id" value="{{ $desgn->id }}">
                        <div class="form-group">
                            <label for="dept_code" class="col-sm-4 control-label">Department Code</label>
                            <div class="col-sm-12">
                                <select id="dept_code" name="dept_code" class="form-control select2" required>
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($dept as $dpt)
                                        <option value="{{ $dpt->dept_code }}" {{ $dpt->dept_code == $desgn->dept_code ? 'selected' : '' }}>{{ $dpt->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desgn_code" class="col-sm-4 control-label">Designation Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="desgn_code" name="desgn_code"
                                      value="{{ $desgn->desgn_code }}" placeholder="Designation Code" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desgn_name" class="col-sm-4 control-label">Designation Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="desgn_name" name="desgn_name"
                                      value="{{ $desgn->desgn_name }}" placeholder="Designation Name" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pay_level" class="col-sm-4 control-label">Pay Level</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="pay_level" name="pay_level"
                                       value="{{ $desgn->pay_level }}" placeholder="Pay Level"  />
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary pull-right" id="saveBtn" value="create">Save Changes
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
