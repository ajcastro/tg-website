@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-logo">
              <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                <defs>
                  <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                    <stop stop-color="#000000" offset="0%"></stop>
                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                  </lineargradient>
                  <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                  </lineargradient>
                </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                    <g id="Group" transform="translate(400.000000, 178.000000)">
                      <path class="text-primary" id="Path"
                        d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                        style="fill:currentColor"></path>
                      <path id="Path1"
                        d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                        fill="url(#linearGradient-1)" opacity="0.2"></path>
                      <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                        points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                      <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                        points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                      <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                        points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                    </g>
                  </g>
                </g>
              </svg></span>
            <h2 class="brand-text mb-0">Vuexy</h2>
          </a>
        </li>
      </ul>
    </div>
  @else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif
<div class="navbar-container d-flex content">
  <div class="bookmark-wrapper d-flex align-items-center">
    @if (is_auth())
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
            data-feather="menu"></i></a></li>
    </ul>
    @endif
    <ul class="nav navbar-nav bookmark-icons">
      <li class="nav-item">

        <a class="navbar-brand" href="/">
          <img src="{{ \App\Models\Website::getCurrentWebsite()->setting->logo_url }}" height="38" class="" />
          &nbsp;
          TELE<span>GAMING</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="d-flex flex-column justify-content-end w-100 d-md-none">
    <div class="d-flex justify-content-end w-100">
      <a
        id="mobileNavBarSvg"
        class="navbar-toggler"
        data-bs-toggle="collapse"
        data-bs-target="#mobileNavBar"
        style="color:white"
      >
        <i class="ficon" data-feather="menu"></i>
      </a>
    </div>
  </div>
  <div class="mobileNavView collapse" id="mobileNavBar">
      <ul class="nav navbar-nav d-flex flex-column">
        @each('panels.navbar-submenu-mobile', App\Models\Menu::tree(), 'menu')
      </ul>
  </div>
  @include('panels.navbar-menu')
</div>
</nav>

<!-- END: Header-->
