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
	@if(Session::has('message'))
	<p style="margin-top:-10px" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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