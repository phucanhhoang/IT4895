{{-- Trang hiển thị kết quả tìm kiếm --}}
@extends('layout.layout')
@section('title')
BookStore - Result search
@stop

@section('content')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Kết quả tìm kiếm
</nav>
<div class="wraper col-md-12 col-sm-12">
    {{--
    <div class="container box-item"> --}}
        <div class="box-item-title">Kết quả tìm kiếm cho từ khóa "{{$key_word}}"
            <!--		<span class='sort-box pull-right'>Sắp xếp -->
            <!--			<select id="ddlSort" name="ddlSort" class="form-control">-->
            <!--                <option value="name"></option>-->
            <!--                <option value="name">Tên sách</option>-->
            <!--                <option value="price_up">Giá tăng dần</option>-->
            <!--                <option value="price_down">Giá giảm dần</option>-->
            <!--            </select>-->
            <!--		</span>-->
        </div>
        <div id="item-block">
            @foreach($books as $book)
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
        {{--
    </div>
    --}}
</div>

@stop

@section('javascript')
<script>

</script>
@stop