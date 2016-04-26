<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul id="sidebar-menu" class="sidebar-menu">
            <li class="">
                <a href="{{asset('adpage')}}">
                    <i class="fa fa-home"></i> <span>Trang chủ</span>
                </a>
            </li>
            <li class="header">CHỨC NĂNG</li>
            <li>
                <a href="{{asset('adpage/order')}}">
                    <i class="fa fa-file-text-o"></i> <span>Quản lý đơn hàng</span>
                    <!--          @if(App\Order::where('shipped', '=', 0)->where('seen', '=', 0)->count() > 0)-->
                    <!--          <small class="label pull-right bg-green">new</small>-->
                    <!--          @endif-->
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Quản lý sản phẩm</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{asset('adpage/genre')}}"><i class="fa fa-circle-o"></i> <span>Thể loại</span></a>
                    </li>
                    <li><a href="{{asset('adpage/author')}}"><i class="fa fa-circle-o"></i> <span>Tác giả</span></a>
                    </li>
                    <li><a href="{{asset('adpage/publisher')}}"><i class="fa fa-circle-o"></i> <span>Nhà xuất bản</span></a>
                    </li>
                    <li><a href="{{asset('adpage/book')}}"><i class="fa fa-circle-o"></i> <span>Sách</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Quản lý tài khoản</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{asset('adpage/customer')}}"><i class="fa fa-circle-o"></i>
                            <span>Khách hàng</span></a></li>
                    <li><a href="{{asset('adpage/account')}}"><i class="fa fa-circle-o"></i> <span>Quản trị viên</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{asset('adpage/statistic')}}">
                    <i class="fa fa-line-chart"></i> <span>Thống kê doanh số</span>
                </a>
            </li>
            <!--      <li>-->
            <!--        <a href="{{asset('adpage/trash')}}">-->
            <!--          <i class="fa fa-trash"></i> <span>Thùng rác</span>-->
            <!--        </a>-->
            <!--      </li>-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
