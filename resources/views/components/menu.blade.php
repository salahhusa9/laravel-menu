<ul class="{{ $menu->getUlClass() }}">

    @foreach ($menu->getMenu() as $item)
        <li
            class="
                {{ $menu->getLiClass() }} 
                {{ $item->addLiActiveClassIfActive() }}
                {{ $item->addLiOpenClassIfHaveActiveSubmenu() }}
            ">
            <a href="{{ route($item->routeName) }}"
                class="{{ $item->hasSubmenu() ? $menu->getConfig('a_sub_menu_class') : $menu->getConfig('a_class') }} {{ Route::is($item->routeName) ? $menu->getConfig('a_active_class') : '' }}"
                @if ($item->target) target="{{ $item->target }}" @endif>
                @if ($item->icon)
                    <i class="{{ $menu->getConfig('icon_class') }} {{ $item->icon }}"></i>
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
