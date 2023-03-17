<ul class="{{ $menu->configs['ul_class'] }}">

    @foreach ($menu->items as $item)
        <li
            class="{{ $menu->configs['li_class'] }} {{ Route::is($item->routeName) ? $menu->configs['li_active_class'] : '' }}">
            <a href="{{ route($item->routeName) }}" class="{{ $menu->configs['a_class'] }} {{ Route::is($item->routeName) ? $menu->configs['a_active_class'] : '' }}"
                @if ($item->target) target="{{ $item->target }}" @endif>
                @if ($item->icon)
                    <i class="{{ $item->icon }}"></i>
                @endif

                <div>{{ $item->title }}</div>

                @if ($item->badge)
                    <div class="{{ $menu->configs['badge_class'] }} {{ $item->badgeClass }}">{{ $item->badgeName }}
                    </div>
                @endif
            </a>
        </li>
    @endforeach

</ul>
