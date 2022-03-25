@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'TeleGaming') --}}

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
<div class="row landing-banner-image-wrapper">
  <div class="col">
  </div>
  <div class="col-xs-12 col-md-6" style="min-height: 450px;">
    @guest
    <x-auth.login-card />
    @endguest
  </div>
  <div class="col-xs-12">
    @include('website.landing-page.slider')
  </div>
</div>
<!-- INCLUDE MODALS  -->
@auth
  @include('website.deposit.modal')
  @include('website.withdraw.modal')
  @include('website.profile.modal')
@endauth
<!-- END MODALS  -->

@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection

@section('page-script')
{{-- Page Script files --}}
<script>
window.swalSuccess = function (text) {
  Swal.fire({
    text: text,
    icon: 'success',
    customClass: {
      confirmButton: 'btn btn-primary'
    },
    buttonsStyling: false
  });
}
</script>
@endsection
