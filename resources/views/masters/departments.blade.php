@extends('layouts.app')
@section('page_title')
    Departments
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DEPARTMENT</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item active">Departments</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Departments</h3>

                    <div class="card-tools">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary add_dept" id="add_dept">
                            <i class="fas fa-plus-circle"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped tbl-dept" id="tbl-dept">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Department Code</th>
                            <th>Department Name</th>
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
                        <input type="hidden" name="dept_id" id="dept_id">
                        <div class="form-group">
                            <label for="dept_code" class="col-sm-4 control-label">Department Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="dept_code" name="dept_code"
                                       placeholder="Department Code" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept_name" class="col-sm-4 control-label">Department Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="dept_name" name="dept_name"
                                       placeholder="Department Name" required />
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary pull-right" id="saveBtn" value="create">Save changes
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
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/datatables-buttons/css/buttons.bootstrap4.min.css')}}" />
@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('js/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script>
        $(function () {
            var str = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.tbl-dept').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'excelHtml5',
                //     'pdfHtml5'
                // ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('departments') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'dept_code', name: 'dept_code'},
                    {data: 'dept_name', name: 'dept_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#add_dept').click(function () {
                str = "Department added successfully";
                $('#saveBtn').val("Save");
                $('#id').val('');
                $('#ajaxForm').trigger("reset");
                $('#modalHeading').html("Add New Department");
                $('#ajaxModal').modal('show');
            });

            $('body').on('click', '.edit', function () {
                var dept_id = $(this).data('id');
                str = "Department updated successfully";
                $.get("departments" + '/' + dept_id + '/edit', function (data) {
                    $('#modalHeading').html("Edit Treasury");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    $('#dept_id').val(data.id);
                    $('#dept_code').val(data.dept_code);
                    $('#dept_name').val(data.dept_name);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#ajaxForm').serialize(),
                    url: "{{ route('department.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        toastr.success(str, "Success");
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
            });
            $('body').on('click', '.delete', function () {
                var dept_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "departments/delete" + '/' + dept_id,
                    success: function (data) {
                        toastr.success("success", "Department deleted successfully", data);
                        table.draw();
                    },
                    error: function (data) {
                        toastr.error("Error", "Error", data);
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>
@endsection
