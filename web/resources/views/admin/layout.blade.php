<?php
/*layout chung trong project 
 *gom co 
 		header
 			--banner
 			--navigator
 		body
 			--sidebar --content
 		footer	
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('title')</title>
    {{-- {{ HTML::style('/bootstrap/css/bootstrap.css'); }} --}}
    <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}">
    <!-- alert animation style -->
    <link rel="stylesheet" href="{{asset('plugins/alert-animation/alert.animation.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
    <!-- MyStyle -->
    <link rel="stylesheet" href="{{asset('css/style.admin.css')}}">

    @yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.include.header')

    @include('admin.include.sidebar')
    {{-- Content --}}
    <div class="content-wrapper" style="min-height: 916px;">
        @yield('content')
    </div>
    @if (session('message'))
    <div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa {{session('fa-class')}}"></i>
        {{ session('message') }}
    </div>
    @endif
    <div id="ajaxAlert" class="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i id="alert-icon" class="icon fa"></i>
        <span id="alert-content"></span>
    </div>
    {{-- Footer --}}
    @include('admin.include.footer')
</div>
<!-- jQuery 2.1.4 -->
<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="{{asset('js/dashboard2.js')}}"></script>
-->
<!-- AdminLTE Demo -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('js/back-to-top.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('js/accounting.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Datetime range
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePicker12Hour: false,
            timePickerIncrement: 30,
            format: 'DD/MM/YYYY h:mm A'
        });

        //Checkbox style
        setCheckboxStyle();

        //Set style cho alert
        var window_width = $(window).width();
        var alert_width = 400;
        if (window_width < alert_width) {
            alert_width = window_width - 20;
        }
        $('#myAlert').attr('style', 'width:' + alert_width + 'px;left:' + (window_width - alert_width) / 2 + 'px');
        $('#ajaxAlert').attr('style', 'width:' + alert_width + 'px;display:none;left:' + (window_width - alert_width) / 2 + 'px');

        //Set active cho sidebar-menu
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().parent().addClass('active');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().addClass('menu-open');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().attr('style', 'display: block');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().addClass('active');
    });
    function setCheckboxStyle() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    }
    function resetForm(id) {
        arrInput = $('#' + id).find('input');
        for (var i = 0; i < arrInput.length; i++) {
            $(arrInput[i]).val('');
        }
        arrArea = $('#' + id).find('textarea');
        for (var i = 0; i < arrArea.length; i++) {
            $(arrArea[i]).val('');
        }
        arrSelectBox = $('#' + id).find('select');
        for (var i = 0; i < arrSelectBox.length; i++) {
            $(arrSelectBox[i]).val('');
        }
    }
</script>
@yield('javascript')
</body>
</html>