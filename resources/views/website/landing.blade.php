@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'TeleGaming') --}}


@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
@endsection

@section('content')
<div class="row landing-banner-image-wrapper">
  <div class="col">
  </div>
  @guest
  <div class="col-xs-12 col-md-6">
    <x-auth.login-card />
  </div>
  <div class="row">
    <div class="col-sm-12">
      @include('website.landing-page.slider')
    </div>
  </div>
  @endguest
</div>

@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
{{-- Page Script files --}}
@endsection
