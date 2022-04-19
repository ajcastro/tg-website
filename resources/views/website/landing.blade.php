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
  @php
    $running_text_announcement = \App\Models\Website::getCurrentWebsite()->setting->running_text_announcement;
  @endphp
  <div class="col-xs-12 col-sm-5 col-md-3 p-0"  style="margin-top: 22px;">
    <div class="alert w-100" role="alert" style="background-color: #000; border-radius: 0px; color: #fff; font-size: 12px; min-height: 40px;">
      <div id="realtime-clock" class="alert-body text-center">
        {{ $running_text_announcement }}
      </div>
    </div>
  </div>
  @if ($running_text_announcement)
  <div class="col-xs-12 col-sm-7 col-md-9 p-0"  style="margin-top: 22px;">
    <marquee class="alert w-100" role="alert" style="background-color: #283046; border-radius: 0px; color: #fff; min-height: 40px;">
      <div class="alert-body">
        {{ $running_text_announcement }}
      </div>
    </marquee>
  </div>
  @endif

  <div class="col">
  </div>
  <div class="col-xs-12 col-md-6" style="min-height: 450px; margin-top: 0px;">
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
  @include('website.transactions.modal')
  @include('website.change_password.modal')
  @include('website.member_bank.modal')
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
window.setFormErrors = function ($form, errors) {
  var formId = $form.attr('id');

  $('#'+formId+' .invalid-feedback.d-block').remove();

  for (var key in errors) {
    var messages = errors[key];
    var divs = '';
    $(messages).each(function (index, message) {
      divs += '<div class="invalid-feedback d-block">'+message+'</div>'
    })
    $(divs).insertAfter('#'+formId+' [name='+key+']')
  }
}
</script>
@endsection
