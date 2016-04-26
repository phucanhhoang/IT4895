<?php
//side bar o ben trai cua man hinh
?>

{{-- @if(!Auth::check()) --}}
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">THỂ LOẠI SÁCH</li>
            @foreach (App\Genre::orderBy('name')->get() as $genre)
            <li class="treeview">
                <span class="tree-item"><a href="{{asset('genre/'.$genre->id)}}">{{$genre->name}}</a></span>
                <!--
                @if(App\GenreDetail::where('genre_id', $genre->id)->get()->count() > 0)
                              <a href="#">
                                 <i class="fa fa-angle-left pull-right"></i>
                              </a>
                              <ul class="treeview-menu" style="display: none;">
                                  @foreach(App\GenreDetail::where('genre_id', $genre->id)->get() as $genre_item)
                                <li><a href="{{asset('genre/'.$genre_item->id)}}">{{$genre_item->name}}</a></li>
                                  @endforeach
                              </ul>
                @endif
                -->
            </li>
            @endforeach
        </ul>
    </section>
</aside>
{{-- @endif --}}