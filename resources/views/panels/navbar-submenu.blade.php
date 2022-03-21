

@if ((count($menu->children) > 0) AND ($menu->parent_id == 0))
    <li class="nav-item dropdown d-none d-lg-block">
        <a href="{{ url($menu->slug) }}" class="nav-link " role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $menu->title }}
        </a>

@else
    <li class="nav-item d-none d-lg-block @if($menu->parent_id === 0 && count($menu->children) > 0) dropdown @endif">
        <!-- <a href="{{ url($menu->slug) }}" class="nav-link " data-bs-toggle="dropdown" aria-expanded="false"> -->
        <a href="{{ url($menu->slug) }}" class="nav-link dropdown-item">

        @if ($menu->parent_id === 0)
        <!-- <img class="header-menu" src="{{ asset($menu->imgloc) }}" alt=""> -->
            {{ $menu->title }}
        <!-- </img> -->
        @else
        <div class="menuitem">
            <div class="submenuitem-img">
                <img src="{{ asset($menu->imgloc) }}" alt="">
            </div>
            <div class="submenuitem-text">
                {{ $menu->title }}
            </div>
        </div>
        @endif
    </a>
@endif

@if (count($menu->children) > 0)
    <ul class="@if($menu->parent_id !== 0 && (count($menu->children) > 0)) submenu @endif dropdown-menu" aria-labelledby="dropdownBtn">
        @foreach($menu->children as $menu)
            @include('panels.navbar-submenu', $menu)
        @endforeach
    </ul>
@endif
    </li>
