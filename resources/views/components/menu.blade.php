<ul class="{{ $menu->isSubmenu() ? $menu->getConfig('ul_sub_menu_class') : $menu->getConfig('ul_class') }}">

    @foreach ($menu->getMenu() as $item)
        <li
            class="
                {{ $menu->isSubmenu() ? $menu->getConfig('li_sub_menu_class') : $menu->getConfig('li_class') }} 
                {{ Route::is($item->routeName) ? $menu->getConfig('li_active_class') : '' }}
                {{ $item->hasActiveSubmenu() ? $menu->getConfig('li_sub_menu_open_class') : '' }}
            ">
            <a href="{{ route($item->routeName) }}"
                class="{{ $item->hasSubmenu() ? $menu->getConfig('a_sub_menu_class') : $menu->getConfig('a_class') }} {{ Route::is($item->routeName) ? $menu->getConfig('a_active_class') : '' }}"
                @if ($item->target) target="{{ $item->target }}" @endif>
                @if ($item->icon)
                    <i class="{{ $menu->getConfig('icon_class') }}{{ $item->icon }}"></i>
                @endif

                <div>{{ $item->name }}</div>

                @if ($item->badgeName)
                    <div class="{{ $menu->getConfig('badge_class') }} {{ $item->badgeClass }}">{{ $item->badgeName }}
                    </div>
                @endif
            </a>

            @if ($item->hasSubmenu())
                @include('menu::components.menu', ['menu' => $item->getSubmenu()])
            @endif
        </li>
    @endforeach

</ul>
