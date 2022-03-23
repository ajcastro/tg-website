<ul class="nav navbar-nav align-items-center ms-auto">
  @each('panels.navbar-submenu', App\Models\Menu::tree(), 'menu')

  {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
        data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li> --}}

  <a class="nav-link menu-toggle d-block d-lg-none" href="javascript:void(0);">
    <i class="ficon" data-feather="menu"></i>
  </a>

  <div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-dark p-4">
    <h5 class="text-white h4">Collapsed content</h5>
    <span class="text-muted">Toggleable via the navbar brand.</span>
  </div>
</div>
<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</ul>
