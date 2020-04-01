@extends('layouts.app')
@section('page_title')
    7 Pay Matrix
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>7<sup>th</sup> PAY MATRIX</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item">Master</li>
                            <li class="breadcrumb-item active">7<sup>th</sup> Pay Matrices</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">7<sup>th</sup> Pay Matrices</h3>

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
                            <th>Pay Level</th>
                            <th>Pay Index</th>
                            <th>Basic Pay</th>
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
                            <label for="pay_level" class="col-sm-4 control-label">Pay Level</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="pay_level" name="pay_level"
                                       placeholder="Pay Level" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pay_index" class="col-sm-4 control-label">Pay Index</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="pay_index" name="pay_index"
                                       placeholder="Pay Index" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="basic_pay" class="col-sm-4 control-label">Basic Pay</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="basic_pay" name="basic_pay"
                                       placeholder="Basic Pay" required />
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
            var table = $('.tbl-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('matrices') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pay_level', name: 'pay_level'},
                    {data: 'pay_index', name: 'pay_index'},
                    {data: 'basic_pay', name: 'basic_pay'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#add_new').click(function () {
                str = "Pay Matrix added successfully";
                $('#saveBtn').val("Save");
                $('#id').val('');
                $('#ajaxForm').trigger("reset");
                $('#modalHeading').html("Add New Pay Matrix");
                $('#ajaxModal').modal('show');
            });

            $('body').on('click', '.edit', function () {
                var try_id = $(this).data('id');
                str = "Pay Matrix updated successfully";
                $.get("7-pay-matrix" + '/' + try_id + '/edit', function (data) {
                    $('#modalHeading').html("Edit Pay Matrix");
                    $('#saveBtn').val("Update");
                    $('#ajaxModal').modal('show');
                    $('#id').val(data.id);
                    $('#pay_level').val(data.pay_level);
                    $('#pay_index').val(data.pay_index);
                    $('#basic_pay').val(data.basic_pay);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#ajaxForm').serialize(),
                    url: "{{ route('matrix.store') }}",
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
                    url: "7-pay-matrix/delete" + '/' + try_id,
                    success: function (data) {
                        toastr.success("success", "Pay Matrix deleted successfully", data);
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
