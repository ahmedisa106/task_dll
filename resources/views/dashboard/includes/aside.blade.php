<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('assets/dashboard')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth('admin')->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @permission('read_categories')
            <li>
                <a href="{{route('dashboard.categories.index')}}">
                    <i class="fa fa-list"></i> <span>Categories</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>
            @endpermission
            {{--<li>
                <a href="{{route('dashboard.products.index')}}">
                    <i class="fa fa-product-hunt"></i> <span>Products</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>--}}
            @permission('read_admins')
            <li>
                <a href="{{route('dashboard.admins.index')}}">
                    <i class="fa fa-users"></i> <span>Admins</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>
            @endpermission
            @permission('read_users')
            <li>
                <a href="{{route('dashboard.users.index')}}">
                    <i class="fa fa-user-circle"></i> <span>Users</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>
            @endpermission
            <li>
                <a href="{{route('dashboard.user_products.index')}}">
                    <i class="fa fa-shopping-cart"></i> <span>User Products</span>
                    <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
