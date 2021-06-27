<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">AFS</a>
        </div>

        <ul class="sidebar-menu">

            @foreach(config('menu') as $menu)

                @if(permission_check($menu['gate'], 'show'))
                    @if(isset($menu['submenus']))
                        <li class="dropdown {{ is_active($menu['is_active']) }}">
                            <a href="#" class="nav-link has-dropdown"><i class="{{ $menu['icon'] }}"></i><span>{{ $menu['title'] }}</span></a>
                            <ul class="dropdown-menu">
                                @foreach($menu['submenus'] as $submenu)
                                    <li class="{{ is_active($submenu['is_active']) }}">
                                        <a class="nav-link" href="{{ route($submenu['route']) }}">{{ $submenu['title'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="{{ is_active($menu['is_active']) }}">
                            <a class="nav-link" href="{{ route($menu['route']) }}">
                                <i class="{{ $menu['icon'] }}"></i> <span>{{ $menu['title'] }}</span>
                            </a>
                        </li>
                    @endif
                @endif

            @endforeach

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split" target="_blank">
                <i class="fas fa-rocket"></i> Siteyi görüntüle
            </a>
        </div>
    </aside>
</div>
