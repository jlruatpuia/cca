@extends('layouts.app')
@section('page_title')
    Edit DDO
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DDO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item">DDO</li>
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
                    <h3 class="card-title">Edit DDO</h3>
                </div>
                <div class="card-body">
                    <form id="ajaxForm" name="ajaxForm" action="{{ route('ddo.update', ['id' => $ddo->id]) }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input type="hidden" name="id" id="id" value="{{ $ddo->id }}">
                        <div class="form-group">
                            <label for="ddo_code" class="col-sm-4 control-label">DDO Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_code" name="ddo_code"
                                       placeholder="DDO Code" value="{{ $ddo->ddo_code }}" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ddo_desc" class="col-sm-4 control-label">DDO Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_desc" name="ddo_desc"
                                       value="{{ $ddo->ddo_desc }}" placeholder="DDO Description" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept_code" class="col-sm-4 control-label">Department Code</label>
                            <div class="col-sm-12 deptm">
                                <select class="form-control select2" id="dept_code" name="dept_code">
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($dept as $dpt)
                                        <option value="{{ $dpt->dept_code }}" {{ $ddo->dept_code == $dpt->dept_code ? 'selected' : '' }}>{{ $dpt->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ddo_name" class="col-sm-4 control-label">DDO Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_name" name="ddo_name"
                                       value="{{ $ddo->ddo_name }}" placeholder="DDO Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="treasury_code" class="col-sm-4 control-label">Treasury Code</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="treasury_code" name="treasury_code">
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($tries as $try)
                                        <option value="{{ $try->treasury_code }}" {{ $ddo->treasury_code == $try->treasury_code ? 'selected' : '' }}>{{ $try->treasury_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bank_code" class="col-sm-4 control-label">Bank Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="bank_code" name="bank_code"
                                      value="{{ $ddo->bank_code }}" placeholder="Bank Code" />
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
@section('css_after')
    <link rel="stylesheet" href="{{asset('js/plugins/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('js/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" />
@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
