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
	<link rel="stylesheet" href="{{asset('resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('resources/assets/bootstrap/css/bootstrap.min.css')}}"/>
	<!-- Ionicons -->
	{{--
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	--}}
	<!-- daterange picker -->
	<link rel="stylesheet" href="{{asset('resources/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

	<link rel="stylesheet" href="{{asset('resources/assets/css/skins/_all-skins.min.css')}}">
	<!-- alert animation style -->
	<link rel="stylesheet" href="{{asset('resources/assets/plugins/alert-animation/alert.animation.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('resources/assets/css/AdminLTE.min.css')}}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('resources/assets/plugins/iCheck/square/blue.css')}}">

	<link rel="stylesheet" href="{{asset('resources/assets/css/style.css')}}"/>
	@yield('style')
</head>
<body>
<input type="hidden" id="_token" name='_token' value="{{ csrf_token() }}"/>

<!--header outside class container because header in full screens-->
	<header>
		@include('include.header')
		
		<!-- navigator bar -->
		{{-- @include('include.nav_user') --}}
		<!-- navigator different with different actor, and we in clude navigator in pages -->
	</header>
{{--
<div class="container content">@yield('breadcrumbs')</div>
--}}
	
	{{-- Content --}}
<div id="main-body" class="container main">
	<!--sidebar content-->
	<div id="sidebar" class='col-md-3 col-sm-3 hidden-xs'>@include('include.sidebar')</div>

	<!--main content-->
	<div id='content' class='col-md-9 col-sm-9'>
		@yield('content')
	</div>
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
<footer>@include('include.footer')</footer>

<!-- jQuery 2.1.4 -->
<script src="{{asset('resources/assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('resources/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('resources/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('resources/assets/plugins/fastclick/fastclick.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('resources/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('resources/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('resources/assets/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="{{asset('js/dashboard2.js')}}"></script>
-->
<!-- AdminLTE Demo -->
<script src="{{asset('resources/assets/js/demo.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('resources/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('resources/assets/js/back-to-top.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('resources/assets/js/accounting.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
	$(document).ready(function () {
		var main_height = $('#main-body').height();
		var content_height = $('#content').height();
		if (content_height < main_height) {
			$('#content').attr('style', 'min-height:' + main_height + 'px');
		}
		//Set style cho alert
		var window_width = $(window).width();
		var alert_width = 400;
		if (window_width < alert_width) {
			alert_width = window_width - 20;
		}
		$('#myAlert').attr('style', 'width:' + alert_width + 'px;left:' + (window_width - alert_width) / 2 + 'px');
		$('#ajaxAlert').attr('style', 'width:' + alert_width + 'px;display:none;left:' + (window_width - alert_width) / 2 + 'px');

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	});
</script>
@yield('javascript')
	
</body>
</html>