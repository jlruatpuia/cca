
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CCA | @yield('page_title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('js/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('js/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
    @yield('css_after')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('includes.sidebar')
    @yield('content')
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.2
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
@yield('js_after')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="../../dist/js/demo.js"></script>--}}
<script>
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}")
    @endif
    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif
</script>
</body>
</html>
