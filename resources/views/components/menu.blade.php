<ul class="{{ $menu->getUlClass() }}">

    @foreach ($menu->getMenu() as $item)
        @if ($item->canShow())
            <li
                class="
                    {{ $menu->getLiClass() }} 
                    {{ $item->addLiActiveClassIfActive() }}
                    {{ $item->addLiOpenClassIfHaveActiveSubmenu() }}
                ">
                <a href="{{ $item->getUrl() }}" id="{{ $item->id }}" class="{{ $item->getAClass() }} {{ $item->addAClassIfActive() }}"
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
        @endif
    @endforeach

</ul>
