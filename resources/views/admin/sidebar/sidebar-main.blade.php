<aside class="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">Menu Admin</span>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="active"><a href="{{route('admin-dashboard')}}" style="color:inherit;text-decoration:none;display:block;width:100%;height:100%"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
                    @include('admin.sidebar.sidebar-admin-property-selection')
                    @include('admin.sidebar.sidebar-admin-website-setting')
                    @include('admin.sidebar.sidebar-admin-orders')
                    @include('admin.sidebar.sidebar-admin-agents')
                </ul>
            </nav>
        </aside>