@extends('layout.layout')
@section('title')
	BookStore - Index
@stop

@section('content')
{{-- Panel thông báo --}}
<div id="tmnivoslider" class="hidden-xs">
	<div id="slider">
		<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=12">
			<img src="http://livedemo00.template-help.com/prestashop_39664/modules/tmnivoslider/slides/slide_00.jpg"
				 alt="" title="#htmlcaption1"/>
		</a>
		<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=20">
			<img src="http://livedemo00.template-help.com/prestashop_39664/modules/tmnivoslider/slides/slide_01.jpg"
				 alt="" title="#htmlcaption2"/>
		</a>
		<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=7">
			<img src="http://livedemo00.template-help.com/prestashop_39664/modules/tmnivoslider/slides/slide_02.jpg"
				 alt="" title="#htmlcaption3"/>
		</a>
		<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=15">
			<img src="http://livedemo00.template-help.com/prestashop_39664/modules/tmnivoslider/slides/slide_03.jpg"
				 alt="" title="#htmlcaption4"/>
		</a>
	</div>
	<div id="htmlcaption1" class="nivo-html-caption">
		<h2>Contemporary Athletics And Ancient Greek Ideals</h2>
		<h3 class="author">
			Author:
			<span>Daniel A. Dombrowski</span>
		</h3>
		<h3 class="publisher">
			Publisher:
			<span>University Of Chicago Press</span>
		</h3>
		<h3 class="date">
			Publication Date:
			<span>April 15, 2009</span>
		</h3>
		<h3 class="genre">
			Genre:
			<span>Non-Fiction</span>
		</h3>
		<h4>
			<span class="slide_price">$25.89</span>
			<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=12" class="slide_btn">Shop
				Now!</a>
		</h4>
	</div>
	<div id="htmlcaption2" class="nivo-html-caption">
		<h2>Mandela</h2>
		<h3 class="author">
			Author:
			<span>Daniel A. Dombrowski</span>
		</h3>
		<h3 class="publisher">
			Publisher:
			<span>University Of Chicago Press</span>
		</h3>
		<h3 class="date">
			Publication Date:
			<span>April 15, 2009</span>
		</h3>
		<h3 class="genre">
			Genre:
			<span>Non-Fiction</span>
		</h3>
		<h4>
			<span class="slide_price">$25.89</span>
			<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=20" class="slide_btn">Shop
				Now!</a>
		</h4>
	</div>
	<div id="htmlcaption3" class="nivo-html-caption">
		<h2>Thy Neighbor's Wife</h2>
		<h3 class="author">
			Author:
			<span>Daniel A. Dombrowski</span>
		</h3>
		<h3 class="publisher">
			Publisher:
			<span>University Of Chicago Press</span>
		</h3>
		<h3 class="date">
			Publication Date:
			<span>April 15, 2009</span>
		</h3>
		<h3 class="genre">
			Genre:
			<span>Non-Fiction</span>
		</h3>
		<h4>
			<span class="slide_price">$25.89</span>
			<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=7" class="slide_btn">Shop
				Now!</a>
		</h4>
	</div>
	<div id="htmlcaption4" class="nivo-html-caption">
		<h2>Black Seconds</h2>
		<h3 class="author">
			Author:
			<span>Daniel A. Dombrowski</span>
		</h3>
		<h3 class="publisher">
			Publisher:
			<span>University Of Chicago Press</span>
		</h3>
		<h3 class="date">
			Publication Date:
			<span>April 15, 2009</span>
		</h3>
		<h3 class="genre">
			Genre:
			<span>Non-Fiction</span>
		</h3>
		<h4>
			<span class="slide_price">$25.89</span>
			<a href="http://livedemo00.template-help.com/prestashop_39664/product.php?id_product=15" class="slide_btn">Shop
				Now!</a>
		</h4>
	</div>
</div>
<div class="container box-item">
	<div class="box-item-title">New Book</div>
	@foreach($book_data['newbook'] as $book)
	<a href="{{asset('book/genre/'.$book->id)}}" class="item col-md-3 col-sm-3">
		{{--
		<button href="#" class="circle"><i class="fa fa-shopping-cart"></i></button>
		--}}
		<div class="item-img">
			<img style="max-width: 100%; max-height: 100%;" src="{{$book->image}}" alt="{{$book->title}}"/>
		</div>
		<div class="item-title">{{$book->title}}</div>
		<span class="item-price">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
	</a>
	@endforeach
</div>
@stop

@section('javascript')
{{-- NivoSlider --}}
<script src="{{asset('plugins/nivoSlider/nivo.slider.js')}}"></script>
<script type="text/javascript" charset="utf-8">
	$(window).load(function () {
		$('#slider').nivoSlider({
			effect: 'fade', //Specify sets like: 'fold,fade,sliceDown'
			slices: 10,
			animSpeed: 500, //Slide transition speed
			pauseTime: 5000,
			startSlide: 0, //Set starting Slide (0 index)
			directionNav: true, //Next & Prev
			directionNavHide: false, //Only show on hover
			controlNav: false, //1,2,3...
			controlNavThumbs: false, //Use thumbnails for Control Nav
			controlNavThumbsFromRel: false, //Use image rel for thumbs
			controlNavThumbsSearch: '.jpg', //Replace this with...
			controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
			keyboardNav: true, //Use left & right arrows
			pauseOnHover: true, //Stop animation while hovering
			manualAdvance: false, //Force manual transitions
			captionOpacity: 1.0, //Universal caption opacity
			beforeChange: function () {
			},
			afterChange: function () {
			},
			slideshowEnd: function () {
			} //Triggers after all slides have been shown
		});
	});
</script>
@stop