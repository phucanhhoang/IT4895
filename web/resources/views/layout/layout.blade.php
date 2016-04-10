<?php
/*layout chung trong project 
 *gom co 
 		header
 			--banner
 			--navigator
 		body
 			--content --sidebar
 		footer	
*/
?>

<!DOCTYPE html>
<html>
<head>
	@include('include.head')
	@yield('style')
</head>
<body>
	<!--header outside class container because header in full screens-->
	<header>
			@include('include.header')
		
		<!-- navigator bar -->
		
			{{-- @include('include.nav_user') --}}
			
		<!-- navigator different with different actor, and we in clude navigator in pages -->

	</header>
	@if (session('message'))
	<div class="alert {{session('alert-class')}} alert-dismissable" style="position: absolute;top: 10px;left: 30%;width: 40%;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		{{ session('message') }}
	</div>
	@endif
	{{-- <div class="container content">
		@yield('breadcrumbs')
	</div> --}}
	
	{{-- Content --}}
	<div class="container main">
		{{-- <div id='main'> --}}
			<!--sidebar content-->
			<div id="sidebar" class='col-md-3 col-sm-3'>
				@include('include.sidebar')
			</div>

			<!--main content-->
			<div id='content' class='col-md-9 col-sm-9'>
				@yield('content')		
			</div>

		{{-- </div> --}}
	</div>

	{{-- Footer --}}
	<footer class="footer">
		@include('include.footer')
	</footer>
	
	@yield('javascript')
</body>
</html>