<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BookStore | 404 Page not found</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('resources/assets/bootstrap/css/bootstrap.min.css')}}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('resources/assets/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <!-- <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="error-page" style='width: 490px'>
            <h2 class="headline text-yellow" style="margin-top: 0"> 404</h2>
            <div class="error-content" style='padding-top: 1px'>
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                <p>
                    We could not find the page you were looking for.<br/>
                    return to <a href="{{asset('/')}}">home page</a> or <a href="{{URL::previous()}}"> previous page</a>
                </p>
            </div><!-- /.error-content -->
        </div><!-- /.error-page -->
    </section><!-- /.content -->
</div><!-- ./wrapper -->
</body>
</html>
