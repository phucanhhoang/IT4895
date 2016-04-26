{{-- Trang hiển thị chi tiết sản phẩm --}}
@extends('layout.layout')
@section('title')
BookStore - Book
@stop

@section('content')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    @if(isset($genre))
    <a href="{{asset('genre/'.$genre->id)}}">{{$genre->name}}</a>
    <span class="divider">›</span>
    @endif
    {{$book->title}}
</nav>
<div class="wraper col-md-12 col-sm-12">
    <div class="lg-item-img col-md-4 col-sm-4">
        <img src="{{asset($book->image)}}" alt="{{$book->title}}"/></div>
    <div class="lg-item-info col-md-8 col-sm-8">
        <div class="row-border">
            <span class="title">{{$book->title}}</span>
        </div>
        <div class="row-border">
            <span class='price-left'>{{number_format($book->price, 0, ',', '.')}} vnđ</span>
			<span class='quantity-right'>
				Số lượng:
				<input type='text' class="form-control" id="txtQuantity" value="1"
                       style="margin-right: 8px; width: 33px;">
				<input type='button' class="btn bg-olive btn-flat btn-sm" id='btnAddCart' value="Thêm vào giỏ">
				<input type='button' class="btn bg-olive btn-flat btn-sm" id='btnBuyNow' value="Mua ngay"></span>
        </div>
        <div class="row-border">Tình trạng: còn {{$book->quantity}} cuốn.</div>
        <div class="row-border" style="text-align: justify">{{$book->description_short}}</div>
        <div class="row-border">
            <div class="fb-like" data-href="http://localhost:7070/public/book/{{$book->id}}" data-layout="button_count"
                 data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
    </div>

    <div class="wraper col-md-12 col-sm-12">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#description" data-toggle="tab">Thông tin sách</a>
            </li>
            <li role="presentation">
                <a href="#comment" data-toggle="tab">Bình luận</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="description">{{$book->description}}</div>
            <div class="tab-pane" id="comment">
                <div class="fb-comments" data-href="http://localhost:7070/public/book/{{$book->id}}" data-width="100%"
                     data-numposts="5"></div>
            </div>
        </div>
    </div>
</div>

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
@stop

@section('javascript')
<script>
    var token = $('#_token').val();
    $('#btnAddCart').click(function (event) {
        var id = "{{$book->id}}";
        var quantity = $('#txtQuantity').val();
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();

        $.ajax({
            type: 'POST',
            url: "{{asset('cart/add-cart')}}",
            cache: false,
            data: {id: id, quantity: quantity, _token: token},
            success: function (msg) {
                // console.log(data);
                if (msg === 'true') {
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Thêm vào giỏ hàng thành công");
                    $('#ajaxAlert').show();
                }
                else {
                    $('#ajaxAlert').attr('class', 'alert alert-danger alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-ban');
                    $('#alert-content').html(msg);
                    $('#ajaxAlert').show();
                }
            },
            error: function (msg) {
                console.log(msg);
            }
        });
    });


</script>
@stop