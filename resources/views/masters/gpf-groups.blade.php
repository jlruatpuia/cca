@extends('layouts.app')
@section('page_title')
    GPF Groups
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>GPF GROUPS</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item active">GPF Groups</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">GPF Groups</h3>

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
                            <th>Group ID</th>
                            <th>Group Name</th>
                            <th>Department</th>
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
                            <label for="gpf_id" class="col-sm-4 control-label">Group ID</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="gpf_id" name="gpf_id"
                                       placeholder="Group ID" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gpf_name" class="col-sm-4 control-label">Group Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="gpf_name" name="gpf_name"
                                       placeholder="Group Name" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept_id" class="col-sm-4 control-label">Department</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="dept_id" name="dept_id">
                                    <option value=""> -- SELECT -- </option>
                                    @foreach($dept as $dpt)
                                        <option value="{{ $dpt->id }}">{{ $dpt->dept_name }}</option>
                                    @endforeach
                                </select>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            var table = $('.tbl-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('gpfs') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'group_id', name: 'group_id'},
                    {data: 'group_name', name: 'group_name'},
                    {data: 'department_id', name: 'department_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#add_new').click(function () {
                str = "GPF Group added successfully";
                $('#saveBtn').val("Save");
                $('#id').val('');
                $('#ajaxForm').trigger("reset");
                $('#modalHeading').html("Add New Group");
                $('#ajaxModal').modal('show');
            });

            $('body').on('click', '.edit', function () {
                var try_id = $(this).data('id');
                str = "Group updated successfully";
                $.get("gpf-groups" + '/' + try_id + '/edit', function (data) {
                    $('#modalHeading').html("Edit GPF Groups");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#gpf_id').val(data.group_id);
                    $('#gpf_name').val(data.group_name);
                    $('#dept_id').val(data.dept_id);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#ajaxForm').serialize(),
                    url: "{{ route('gpf.store') }}",
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
                $(this).html('Save');
            });
            $('body').on('click', '.delete', function () {
                var try_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "gpf-groups/delete" + '/' + try_id,
                    success: function (data) {
                        toastr.success("success", "Group deleted successfully", data);
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
