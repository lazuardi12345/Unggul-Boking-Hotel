<aside class="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-title">Menu Admin</span>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    @include('admin.sidebar.sidebar-admin-dashboard')
                    <li class="has-submenu">
                        <span><i class="fa fa-building"></i> Property Selection <i class="fa fa-chevron-down submenu-arrow"></i></span>
                        <ul class="submenu">
                            @include('admin.sidebar.sidebar-admin-location')
                            @include('admin.sidebar.sidebar-admin-property')
                        </ul>
                    </li>
                    @include('admin.sidebar.sidebar-admin-website-setting')
                    @include('admin.sidebar.sidebar-admin-orders')
                    @include('admin.sidebar.sidebar-admin-agents')
                </ul>
            </nav>
        </aside>