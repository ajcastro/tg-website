@extends('layouts/contentLayoutMaster')

@section('title', 'Register')

@section('page-style')
  {{-- Page Css files --}}
@endsection

@section('content')
<div class="row landing-banner-image-wrapper">
  <div class="col">
  </div>
  <div class="col-xs-12 col-md-6">
    <x-auth.register-card />
  </div>
</div>

@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
@endsection
