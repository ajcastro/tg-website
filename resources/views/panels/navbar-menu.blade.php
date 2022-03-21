<ul class="nav navbar-nav align-items-center ms-auto">
  @each('panels.navbar-submenu', App\Models\Menu::tree(), 'menu')

  <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
        data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li>
</ul>
