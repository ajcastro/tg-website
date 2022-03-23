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
  <div class="col-xs-12 col-md-6" style="min-height: 70vh;">
    @guest
    <x-auth.login-card />
    @endguest
  </div>
  <div class="col-xs-12">
    @include('website.landing-page.slider')
  </div>
</div>

@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
{{-- Page Script files --}}
@endsection
