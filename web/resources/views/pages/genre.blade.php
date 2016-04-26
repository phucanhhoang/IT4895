{{-- Trang hiển thị chi tiết sản phẩm --}}
@extends('layout.layout')
@section('title')
BookStore - Genre
@stop

@section('content')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    {{$data['genre']->name}}
</nav>
<div class="wraper col-md-12 col-sm-12">
    {{--
    <div class="container box-item"> --}}
        <div class="box-item-title">{{$data['genre']->name}}
		<span class='sort-box pull-right'>Sắp xếp 
			<select id="ddlSort" name="ddlSort" class="form-control">
                <option value="name"></option>
                <option value="name">Tên sách</option>
                <option value="price_up">Giá tăng dần</option>
                <option value="price_down">Giá giảm dần</option>
            </select>
		</span>
        </div>
        <div id="item-block">
            @foreach($data['books'] as $book)
            <a href="{{asset('book/'.$data['genre']->id.'/'.$book->id)}}" class="item col-md-3 col-sm-3">
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
        {{--
    </div>
    --}}
</div>

@stop

@section('javascript')
<script>
    $('#ddlSort').change(function (event) {
        var genre_id = "{{$data['genre']->id}}";
        var sort_type = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{asset('genre/sort-book')}}",
            cache: false,
            data: {id: genre_id, sort_type: sort_type},
            success: function (data) {
                if (data != 'false') {
                    $('#item-block').html('');
                    for (var i = 0; i < data['books'].length; i++) {
                        var book_link = "{{asset('book')}}" + "\/" + genre_id + "\/" + data['books'][i].id;
                        var price = accounting.formatNumber(data['books'][i].price, 0, ".", ",");
                        $('#item-block').append("<a href='" + book_link + "' class='item col-md-3 col-sm-3'><div class='item-img'><img style='max-width: 100%; max-height: 100%;' src='" + data['books'][i].image + "' alt='" + data['books'][i].title + "' /></div><div class='item-title'>" + data['books'][i].title + "</div><span class='item-price'>" + price + " vnđ</span></a>");
                    }
                }
            }
        });
    });
</script>
@stop