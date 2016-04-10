<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookStore | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{Asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{Asset('css/font-awesome/css/font-awesome.min.css')}}" />
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{Asset('css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{Asset('plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
  @if (session('message'))
  <div class="alert {{session('alert-class')}} alert-dismissable" style="position: absolute;top: 10px;left: 30%;width: 40%;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ session('message') }}
  </div>
  @endif
    <div class="login-box">
      <div class="login-logo">
        <a href="{{Asset('')}}">
        	{{-- <img src="img/login_logo.jpg" alt="Logo Website" style="max-width: 100%; max-height: 100%" /> --}}
        	<b>Book</b>Store
        </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
        <form action="{{ url('/auth/login') }}" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        	<div class="div-row">
				<p id="login-error-mess" style="display:none"></p>
			</div>
          <div class="form-group has-feedback">
            <input id="username" name="username" type="text" class="form-control" placeholder="Account" value="{{ old('username') }}" onkeypress="login_keypress(event);" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <p id="username-error-mess" style="display:none"></p>
          <div class="form-group has-feedback">
            <input id="password" name="password" type="password" class="form-control" placeholder="Password" onkeypress="login_keypress(event);" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <p id="password-error-mess" style="display:none"></p>
          
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name="chkRemember"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">I forgot my account or my password</a><br>
        <a href="{{Asset('auth/register')}}" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{Asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{Asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{Asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });

//	$("#btn-login").on('click',function(){
//		login_click();
//		return false;
//	});
	function login_keypress(e){
		if(e.keyCode == 13)
			login_click();
	}
	function login_click(e){
		var username = $('input[name="username"]').val(),
			password = $('input[name="password"]').val(),
			check = 1;
		if(username == null || username ==''){
			$("#username-error-mess").css({"color":"red","display":"block"});
			$("#username-error-mess").html('Mời bạn nhập username');
			check = 0;
		}
		if(password == null || password ==''){
			$("#password-error-mess").css({"color":"red","display":"block"});
			$("#password-error-mess").html('Mời bạn nhập password');
			check = 0;
		}

		if(check){
			$.ajax({
				type: "POST",
				url: "{{url('auth/login')}}",
				cache: false,
				data: {username: username, password: password},
				success: function(data){
					console.log(data);
					if (data=="false"){
						$("#login-error-mess").css({"color":"red","display":"block"});
						$("#login-error-mess").html('Tài khoản hoặc mật khẩu không chính xác');
					}
					else{
						window.location.href = "{{Asset('/')}}";
					}
				}
			});
		}
		return false;
	}
    </script>
  </body>
</html>
