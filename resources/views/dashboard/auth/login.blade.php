<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('dashboard.index')}}"><b>Auth</b>Dll</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Welcome Admin</p>
        <span class="text-center errors">

        </span>


        <form action="{{route('dashboard.doLogin')}}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<script src="{{asset('assets/dashboard')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/dashboard')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    $('form').on('submit', function (event) {
        event.preventDefault();
        var data = new FormData(this),
            url = event.target.getAttribute('action');
        $.ajax({
            processData: false,
            contentType: false,
            cache: false,
            type: 'post',
            url: url,
            data: data,
            beforeSend: function () {
                $('button:submit').prop('disabled', true).append(' <i class="fa fa-spin fa-spinner"></i> ');
                $('.text-danger').remove();
            },
            success: function () {
                window.location.href = "{{route('dashboard.index')}}"
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    $('.errors').append('<p class="text-danger text-center">' + xhr.responseJSON.error + '</p>');
                }
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (label, error) {
                    let input = $('input[name="' + label + '"]');
                    input.parent().append('<span class="text-danger">' + error + '</span>')
                })
            },
            complete: function () {
                $('button:submit').prop('disabled', false);
                $('.fa-spinner').remove();

            }
        })
    })
</script>
</body>
</html>
