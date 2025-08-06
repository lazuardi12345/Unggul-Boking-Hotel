<!-- <link rel="stylesheet" href="/assets/css/admin_dashboard.css"> -->

<style>
.has-submenu li.active, .has-submenu li:hover {
    background: #f0f4ff;
    color: #1976d2;
}
.has-submenu {
    position: relative;
}
.submenu {
    display: none;
    flex-direction: column;
    margin-left: 18px;
    margin-top: 4px;
}
.has-submenu:hover .submenu {
    display: flex;
}
.submenu-arrow {
    margin-left: auto;
    font-size: 0.9rem;
}
</style>

<li class="has-submenu">
    <span><i class="fa fa-building"></i> Property Selection <i class="fa fa-chevron-down submenu-arrow"></i></span>
    <ul class="submenu">
        @include('admin.sidebar.sidebar-admin-location')
        @include('admin.sidebar.sidebar-admin-properties')
    </ul>                       
</li>