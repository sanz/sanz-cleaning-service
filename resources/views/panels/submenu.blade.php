{{-- For submenu --}}
<ul class="menu-content">
    @foreach($menu as $submenu)
        <?php
            $submenuTranslation = "";
            if(isset($menu->i18n)){
                $submenuTranslation = $menu->i18n;
            }
            if (isset($submenu->badge)){
                $badgeClasses = "badge badge-pill badge-primary float-right";
            }
        ?>
        <li class="{{ (request()->is($submenu->url)) ? 'active' : '' }}">
            <a href="{{ $submenu->url[0] }}">
                <i class="{{ isset($submenu->icon) ? $submenu->icon : "" }}"></i>
                <span class="menu-title" data-i18n="{{ $submenuTranslation }}">{{ __('locale.'.$submenu->name) }}</span>

                @if(isset($submenu->badge))
                    @if ($submenu->url[0] == "client-manage")
                        @isset($countClient)
                            <span class="{{ isset($submenu->badgeClass) ? $submenu->badgeClass.' test' : $badgeClasses.' notTest' }} ">{{$countClient}}</span>
                        @endisset
                    @else
                        <span class="{{ isset($submenu->badgeClass) ? $submenu->badgeClass.' test' : $badgeClasses.' notTest' }} ">{{$submenu->badge}}</span>
                    @endif

                @endif
            </a>

            @if (isset($submenu->submenu))
                @include('panels/submenu', ['menu' => $submenu->submenu])
            @endif
        </li>
    @endforeach
</ul>
