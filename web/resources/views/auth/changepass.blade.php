<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookStore | Chage Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{Asset('resources/assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    --}}
    <link rel="stylesheet" href="{{Asset('resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <!-- Ionicons -->
    {{--
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    --}}
    <!-- alert animation style -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/alert-animation/alert.animation.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{Asset('resources/assets/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{Asset('resources/assets/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
@if (session('message'))
<div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in"
     style="position: fixed;top: 10px;left: 30%;width: 40%;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa {{session('fa-class')}}"></i> {{ session('message') }}
</div>
@endif
<div class="login-box">
    <div class="login-logo">
        <a href="{{Asset('')}}">
            {{-- <img src="img/login_logo.jpg" alt="Logo Website" style="max-width: 100%; max-height: 100%"/> --}}
            <b>Book</b>Store
        </a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Change your password</p>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ asset('user/changepass') }}" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <input type="hidden" name="rtn_url" value="{{URL::previous()}}"/>
            <div class="div-row">
                <p id="login-error-mess" style="display:none"></p>
            </div>
            <div class="form-group has-feedback">
                <input id="cur_pass" name="cur_pass" type="password" class="form-control"
                       placeholder="Current Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <p id="username-error-mess" style="display:none"></p>
            <div class="form-group has-feedback">
                <input id="password" name="password" type="password" class="form-control" placeholder="New Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <p id="password-error-mess" style="display:none"></p>
            <div class="form-group has-feedback">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                       placeholder="Retype New Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <p id="password_match" style="display:none"></p>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">CHANGE PASSWORD
                    </button>
                </div><!-- /.col -->
            </div>
        </form>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{Asset('resources/assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{Asset('resources/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{Asset('resources/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $('#password_confirmation').keyup(function (event) {
        if ($(this).val() == $('#password').val()) {
            $('#password_match').html("<i class='fa fa-check'></i> Mật khẩu đã khớp");
            $('#password_match').removeClass('text-yellow');
            $('#password_match').addClass('text-green');
            $('#password_match').show();
        }
        else {
            $('#password_match').html("<i class='fa fa-warning'></i> Mật khẩu chưa khớp");
            $('#password_match').removeClass('text-green');
            $('#password_match').addClass('text-yellow');
            $('#password_match').show();
        }
    });
</script>
</body>
</html>
