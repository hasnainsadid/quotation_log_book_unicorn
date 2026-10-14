<aside id="layout-menu" class="layout-menu menu-vertical menu"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

    <div class="app-brand demo ">
        <a href="/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('backend/img/logo/unicorn_logo.png') }}" alt="Logo" height="40" class="app-brand-logo-default">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-3">Unicorn</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1 ps ps--active-y">
        <!-- Dashboards -->
        <li class="menu-item @if (request()->routeIs('dashboard')) active @endif open">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div>Dashboards</div>
            </a>
        </li>

        <!-- pages -->
        <li class="menu-header small">
            <span class="menu-header-text">Main pages</span>
        </li>
        <!-- Forms -->
        {{-- @if (hasPermission([
                'quatation-log-books.index',
                'quatation-log-books.create',
                'quatation-log-books.edit',
                'quatation-log-books.destroy',
            ])) --}}
            <li class="menu-item @if (request()->routeIs('quatation-log-books.index', 'quatation-log-books.create', 'quatation-log-books.edit', 'quatation-log-books.delete')) active @endif">
                <a href="{{ route('quatation-log-books.index') }}" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-file-invoice"></i>
                    <div>Quotation Log Book</div>
                </a>
            </li>
        {{-- @endif --}}

        <li class="menu-header small">
            <span class="menu-header-text">Role & Permission</span>
        </li>

        {{-- @if (hasPermission(['roles.index', 'roles.create', 'roles.edit', 'roles.delete'])) --}}
            <li class="menu-item {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-users"></i>
                    <div>Roles</div>
                </a>
            </li>
        {{-- @endif --}}

        {{-- @if (hasPermission(['users.index', 'users.create', 'users.edit', 'users.delete'])) --}}
            <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-user"></i>
                    <div>Users</div>
                </a>
            </li>
        {{-- @endif --}}

        <!-- pages -->

        <li class="menu-header small">
            <span class="menu-header-text">Recycle Bin</span>
        </li>
        <!-- Forms -->
        <li class="menu-item {{ request()->routeIs('*.recycleBin') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-recycle"></i>
                <div>Recycle Bin</div>
            </a>
            <ul class="menu-sub">
                {{-- @if (hasPermission(['categories.destroy']))
                    <li class="menu-item {{ request()->routeIs('categories.recycleBin') ? 'active' : '' }}">
                        <a href="{{ route('categories.recycleBin') }}" class="menu-link">
                            <div>Category</div>
                        </a>
                    </li>
                @endif --}}
                @if (hasPermission(['quatation-log-books.destroy']))
                    <li class="menu-item {{ request()->routeIs('quatation-log-books.recycleBin') ? 'active' : '' }}">
                        <a href="{{ route('quatation-log-books.recycleBin') }}" class="menu-link">
                            <div>Quotation Log Book</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="ti tabler-menu icon-base"></i>
        <i class="ti tabler-chevron-right icon-base"></i>
    </a>
</div>
