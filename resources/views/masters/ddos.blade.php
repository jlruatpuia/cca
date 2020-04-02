@extends('layouts.app')
@section('page_title')
    DDO
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
                            <li class="breadcrumb-item active">DDO</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DDO</h3>

                    <div class="card-tools">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="add_new">
                            <i class="fas fa-plus-circle"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped tbl-data" id="tbl-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>DDO Code</th>
                            <th>DDO Description</th>
                            <th>Department Code</th>
                            <th>DDO Name</th>
                            <th>Treasury Code</th>
                            <th>Bank Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="ajaxForm" name="ajaxForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="ddo_code" class="col-sm-4 control-label">DDO Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_code" name="ddo_code"
                                       placeholder="DDO Code" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ddo_desc" class="col-sm-4 control-label">DDO Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_desc" name="ddo_desc"
                                       placeholder="DDO Description" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept_code" class="col-sm-4 control-label">Department Code</label>
                            <div class="col-sm-12 deptm">
                                <select class="form-control select2" id="dept_code" name="dept_code">
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($dept as $dpt)
                                        <option id="{{ $dpt->dept_code }}" value="{{ $dpt->dept_code }}">{{ $dpt->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ddo_name" class="col-sm-4 control-label">DDO Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ddo_name" name="ddo_name"
                                       placeholder="DDO Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="treasury_code" class="col-sm-4 control-label">Treasury Code</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="treasury_code" name="treasury_code">
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($tries as $try)
                                        <option value="{{ $try->treasury_code }}">{{ $try->treasury_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bank_code" class="col-sm-4 control-label">Bank Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="bank_code" name="bank_code"
                                       placeholder="Bank Code" />
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary pull-right" id="saveBtn" value="create">Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css_after')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/datatables-responsive/css/responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('js/plugins/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('js/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}" />
@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            var str = "";
            var code = "";
            var name = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.tbl-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ddos') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'ddo_code', name: 'ddo_code'},
                    {data: 'ddo_desc', name: 'ddo_desc'},
                    {data: 'dept_code', name: 'dept_code'},
                    {data: 'ddo_name', name: 'ddo_name'},
                    {data: 'treasury_code', name: 'treasury_code'},
                    {data: 'bank_code', name: 'bank_code'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#add_new').click(function () {
                str = "DDO added successfully";
                $('#saveBtn').val("Save");
                $('#id').val('');
                $('#ajaxForm').trigger("reset");
                $('#modalHeading').html("Add New DDO");
                $('#ajaxModal').modal('show');
            });

            $('body').on('click', '.edit', function () {
                var try_id = $(this).data('id');
                str = "DDO updated successfully";
                $.get("ddos" + '/' + try_id + '/edit', function (data) {
                    $('#modalHeading').html("Edit DDO");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#ddo_code').val(data.ddo_code);
                    $('#ddo_desc').val(data.ddo_desc);
                    $('#dept_code').val(data.dept_code);
                    $('#ddo_name').val(data.ddo_name);
                    $('#treasury_code').val(data.treasury_code);
                    $('#bank_code').val(data.bank_code);
                    //code = data.dept_code;
                    //$('div.deptm select').val(data.dept_code);
                    $('.id_100 option[value=' + data.dept_code + ']').attr('selected','selected');
                    //name = data.dept_name;
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#ajaxForm').serialize(),
                    url: "{{ route('ddo.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        toastr.success(str, "Success", data);
                        $('#ajaxForm').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        toastr.error("Error", data);
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
                $(this).html('Save');
            });
            $('body').on('click', '.delete', function () {
                var try_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "ddos/delete" + '/' + try_id,
                    success: function (data) {
                        toastr.success("success", "DDO deleted successfully", data);
                        table.draw();
                    },
                    error: function (data) {
                        toastr.error("Error", "Error", data);
                        console.log('Error:', data);
                    }
                });
            });
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection

