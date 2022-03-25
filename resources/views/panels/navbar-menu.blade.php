<ul class="nav navbar-nav navbar-menu align-items-center ms-auto d-none d-md-inline-flex">
  @each('panels.navbar-submenu', App\Models\Menu::tree(), 'menu')

  {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
        data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li> --}}
</ul>
