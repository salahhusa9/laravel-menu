<ul class="{{ $menu->getConfig('ul_class') }}">

    @foreach ($menu->getMenu() as $item)
        <li
            class="{{ $menu->getConfig('li_class') }} {{ Route::is($item->routeName) ? $menu->getConfig('li_active_class') : '' }}">
            <a href="{{ route($item->routeName) }}" class="{{ $menu->getConfig('a_class') }} {{ Route::is($item->routeName) ? $menu->getConfig('a_active_class') : '' }}"
                @if ($item->target) target="{{ $item->target }}" @endif>
                @if ($item->icon)
                    <i class="{{ $item->icon }}"></i>
                @endif

                <div>{{ $item->title }}</div>

                @if ($item->badge)
                    <div class="{{ $menu->getConfig('badge_class') }} {{ $item->badgeClass }}">{{ $item->badgeName }}
                    </div>
                @endif
            </a>
        </li>
    @endforeach

</ul>
