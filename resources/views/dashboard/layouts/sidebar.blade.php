<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LOGO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{--    @can('home_dashboard')--}}
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    {{--    @endcan--}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{--    @can('view_posts')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Posts Managements</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Posts Managements</h6>

                {{--                    @can('view_posts')--}}
                <a class="collapse-item" href="{{ route('admin.posts.index') }}">All Posts</a>
                {{--                    @endcan--}}

                {{--                    @can('create_posts')--}}
                <a class="collapse-item" href="{{ route('admin.posts.create') }}">Create Posts</a>
                {{--                    @endcan--}}
            </div>
        </div>
    </li>
    {{--    @endcan--}}

    <!-- Nav Item - Utilities Collapse Menu -->
    {{--    @can('view_settings')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings Managements</h6>
                {{--                    @can('view_settings')--}}
                <a class="collapse-item" href="{{ route('admin.settings.index') }}">Setting</a>
                {{--                    @endcan--}}
            </div>
        </div>
    </li>
    {{--    @endcan--}}

    {{--    @can('view_admins')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AdminManagement"
           aria-expanded="true" aria-controls="AdminManagement">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Admins</span>
        </a>
        <div id="AdminManagement" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Admins Managements:</h6>
                {{--                    @can('view_admins')--}}
                <a class="collapse-item" href="{{ route('admin.admins.index') }}">All Admins</a>
                {{--                    @endcan--}}

                {{--                    @can('create_admins')--}}
                <a class="collapse-item" href="{{ route('admin.admins.create') }}">Add New Admin</a>
                {{--                    @endcan--}}
            </div>
        </div>
    </li>
    {{--    @endcan--}}

    {{--    @can('view_roles')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Authorizations"
           aria-expanded="true" aria-controls="Authorizations">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Roles</span>
        </a>
        <div id="Authorizations" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Roles:</h6>
                {{--                    @can('view_roles')--}}
                <a class="collapse-item" href="{{ route('admin.authorizations.index') }}">All Roles</a>
                {{--                    @endcan--}}

                {{--                    @can('create_roles')--}}
                <a class="collapse-item" href="{{ route('admin.authorizations.create') }}">Add New Role</a>
                {{--                    @endcan--}}
            </div>
        </div>
    </li>
    {{--    @endcan--}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    {{--    @can('view_users')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--                    @can('view_users')--}}
                <a class="collapse-item" href="{{ route('admin.users.index') }}">Users</a>
                {{--                    @endcan--}}

                {{--                    @can('create_users')--}}
                <a class="collapse-item" href="{{ route('admin.users.create') }}">Add User</a>
                {{--                    @endcan--}}
            </div>
        </div>
    </li>
    {{--    @endcan--}}

    <!-- Nav Item - Tables -->
    {{--    @can('view_categories')--}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Categories</span></a>
    </li>
    {{--    @endcan--}}

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Contact</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>