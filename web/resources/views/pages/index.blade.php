@extends('layout.layout')
@section('title')
	BookStore - Index
@stop

@section('content')
{{-- Panel thông báo --}}
<div id="tmnivoslider" class="hidden-xs">
	<div id="slider">
		@foreach($book_data['slidebook'] as $book)
		<a href="{{asset('book/genre/'.$book->id)}}">
			<div class="slider-area">
				<img src="{{asset($book->image)}}" alt="{{$book->title}}" title="{{'#htmlcaption'.$book->id}}"
					 onmouseover="this.setAttribute('org_title', this.title); this.title='';"
					 onmouseout="this.title = this.getAttribute('org_title');"/>
			</div>
		</a>
		@endforeach
	</div>
	@foreach($book_data['slidebook'] as $book)
	<div id="{{'htmlcaption'.$book->id}}" class="nivo-html-caption">
		<h2>{{$book->title}}</h2>
		<h3 class="author">
			Author:
			<span>{{$book->author_name}}</span>
		</h3>
		<h3 class="publisher">
			Publisher:
			<span>{{$book->publisher_name}}</span>
		</h3>
		<h3 class="genre">
			Genre:
			<span>{{$book->genre_name}}</span>
		</h3>
		<h4>
			@if($book->sale > 0)
			<span class="slide_price old">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
			<span class="slide_price">{{number_format($book->price - ($book->price * $book->sale / 100), 0, ',', '.')}} vnđ</span>
			@else
			<span class="slide_price">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
			@endif
			<a href="{{asset('book/genre/'.$book->id)}}" class="btn bg-olive btn-flat btn-sm">Xem chi tiết</a>
		</h4>
	</div>
	@endforeach
</div>
<div class="container box-item">
	<div class="box-item-title">New book</div>
	@foreach($book_data['newbook'] as $book)
	<a href="{{asset('book/genre/'.$book->id)}}" class="item col-md-3 col-sm-3">
		@if($book->sale > 0)
		<span class="btn bg-olive btn-flat btn-sm" style="position: absolute; top: 0; right: 0">-{{$book->sale}}%</span>
		@endif
		<div class="item-img">
			<img style="max-width: 100%; max-height: 100%;" src="{{asset($book->image)}}" alt="{{$book->title}}"/>
		</div>
		<div class="item-title">{{$book->title}}</div>
		@if($book->sale > 0)
		<span class="item-price old">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
		<span
			class="item-price">{{number_format($book->price - ($book->price * $book->sale / 100), 0, ',', '.')}} vnđ</span>
		@else
		<span class="item-price">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
		@endif
	</a>
	@endforeach
</div>
<div class="container box-item">
	<div class="box-item-title">Sale</div>
	@foreach($book_data['salebook'] as $book)
	<a href="{{asset('book/genre/'.$book->id)}}" class="item col-md-3 col-sm-3">
		@if($book->sale > 0)
		<span class="btn bg-olive btn-flat btn-sm" style="position: absolute; top: 0; right: 0">-{{$book->sale}}%</span>
		@endif
		<div class="item-img">
			<img style="max-width: 100%; max-height: 100%;" src="{{asset($book->image)}}" alt="{{$book->title}}"/>
		</div>
		<div class="item-title">{{$book->title}}</div>
		<span class="item-price old">{{number_format($book->price, 0, ',', '.')}} vnđ</span>
		<span
			class="item-price">{{number_format($book->price - ($book->price * $book->sale / 100), 0, ',', '.')}} vnđ</span>
	</a>
	@endforeach
</div>
@stop

@section('javascript')
{{-- NivoSlider --}}
<script src="{{asset('resources/assets/plugins/nivoSlider/nivo.slider.js')}}"></script>
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