<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    @include('dashboard.includes.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('dashboard.includes.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('dashboard.includes.aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('dashboard.includes.footer')

    <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->

@include('dashboard.includes.js')
</body>
</html>
