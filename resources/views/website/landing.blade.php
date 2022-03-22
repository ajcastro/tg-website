@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'TeleGaming') --}}


@section('page-style')
  {{-- Page Css files --}}
@endsection

@section('content')
<div class="row landing-banner-image-wrapper">
  <div class="col ">
  </div>
  @guest
  <div class="col">
    <x-auth.login-card />
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
