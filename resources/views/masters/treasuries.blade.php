@extends('layouts.app')
@section('page_title')
    Treasuries
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>TREASURY</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item active">Treasuries</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Treasuries</h3>

                    <div class="card-tools">
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="add_treasury">
                            <i class="fas fa-plus-circle"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped tbl-treasury" id="tbl-treasury">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Treasury Code</th>
                            <th>Treasury Name</th>
                            <th>Address</th>
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
                        <input type="hidden" name="treasury_id" id="treasury_id">
                        <div class="form-group">
                            <label for="treasury_code" class="col-sm-4 control-label">Treasury Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="treasury_code" name="treasury_code"
                                       placeholder="Treasury Code" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="treasury_name" class="col-sm-4 control-label">Treasury Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="treasury_name" name="treasury_name"
                                       placeholder="Treasury Name" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-4 control-label">Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="Address" required />
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
@endsection
@section('js_after')
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(function () {
            var str = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.tbl-treasury').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('treasuries') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'treasury_code', name: 'treasury_code'},
                    {data: 'treasury_name', name: 'treasury_name'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#add_treasury').click(function () {
                str = "Treasury added successfully";
                $('#saveBtn').val("Save");
                $('#id').val('');
                $('#ajaxForm').trigger("reset");
                $('#modalHeading').html("Add New Treasury");
                $('#ajaxModal').modal('show');
            });

            $('body').on('click', '.edit', function () {
                var try_id = $(this).data('id');
                str = "Treasury updated successfully";
                $.get("treasuries" + '/' + try_id + '/edit', function (data) {
                    $('#modalHeading').html("Edit Treasury");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    $('#treasury_id').val(data.id);
                    $('#treasury_code').val(data.treasury_code);
                    $('#treasury_name').val(data.treasury_name);
                    $('#address').val(data.address);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#ajaxForm').serialize(),
                    url: "{{ route('treasury.store') }}",
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
                var try_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "treasuries/delete" + '/' + try_id,
                    success: function (data) {
                        toastr.success("success", "Treasury deleted successfully", data);
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
