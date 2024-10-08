<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if (!empty(Auth::guard('admin')->user()->image))
                <div class="image">
                    <img src="{{ asset('admin/img/profile/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
                </div>
            @endif
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link @if (Session::get('page') == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item @if (Session::get('menu') == 'pages-management') menu-open @endif">
                    <a href="#" class="nav-link @if (Session::get('menu') == 'pages-management') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pages Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/cms-pages') }}" class="nav-link @if (Session::get('page') == 'cms-pages') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>CMS Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @if (Session::get('menu') == 'admin-management') menu-open @endif">
                    <a href="#" class="nav-link @if (Session::get('menu') == 'admin-management') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Admin Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/update-password') }}" class="nav-link @if (Session::get('page') == 'update-password') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/edit-profile') }}" class="nav-link @if (Session::get('page') == 'edit-profile') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subadmins</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>