<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.rsvp.index') }}" class="nav-link {{ Nav::isRoute('admin.rsvp.index') }}">
                <i class="fa fa-book fa-2"></i>
                <p>RSVP</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.video') }}" class="nav-link {{ Nav::isRoute('admin.video') }}">
                <i class="fa fa-video fa-2"></i>
                <p>Video</p>
            </a>
        </li>
        <li class="nav-item has-treeview {{ Nav::hasSegment(['lucky-draw', 'lucky-draw-winners'], 1) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Nav::hasSegment(['lucky-draw', 'lucky-draw-winners'], 1) }}">
                <i class="fa fa-trophy fa-2"></i>
                <p>
                    Lucky Draw
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.lucky-draw') }}"  target="_blank" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lucky Draw Page</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('admin.lucky-draw-winners') }}" class="nav-link {{ Nav::isResource('lucky-draw-winners') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lucky Draw Winners</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.preselected-winners') }}" class="nav-link {{ Nav::isRoute('admin.preselected-winners') }}">
                <i class="fa fa-clipboard-check fa-2"></i>
                <p>Pre Selected Winners</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.attendance') }}" class="nav-link {{ Nav::isRoute('admin.attendance') }}">
                <i class="fa fa-user fa-2"></i>
                <p>Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.config') }}" class="nav-link {{ Nav::isRoute('admin.config') }}">
                <i class="fa fa-cogs fa-2"></i>
                <p>Config</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.comments') }}" class="nav-link {{ Nav::isRoute('admin.comments') }}">
                <i class="fas fa-comments fa-2"></i>
                <p>Comments</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
