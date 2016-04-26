<header class="main-header">

    <!-- Logo -->
    <a href="{{asset('adpage')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Book</b>Store</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#">
                        <span>Xin chào, <b>{{Auth::user()->username}}</b></span>
                    </a>
                </li>
                <li>
                    <a href="{{asset('')}}" title="Trang bán hàng">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </li>
                <li>
                    <a href="{{asset('auth/logout')}}" title="Đăng xuất">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</header>