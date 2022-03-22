@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'TeleGaming') --}}


@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-basic px-2">
  <div class="auth-inner my-2">
    <!-- Login basic -->
    <div class="card mb-0">
      <div class="card-body">

        <h4 class="card-title mb-1">Login</h4>

        <form class="auth-login-form mt-2" action="/login" method="POST">
          @csrf
          <div class="mb-1">
            <label for="login-username" class="form-label">Username</label>
            <input
              type="text"
              class="form-control"
              id="login-username"
              name="username"
              placeholder="username"
              aria-describedby="login-username"
              tabindex="1"
              autofocus
              value=""
            />
            @foreach ($errors->get('username') as $errorMessage)
            <span id="basic-default-name-error" class="error">{{ $errorMessage }}</span>
            @endforeach
          </div>

          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">Password</label>
              {{-- <a href="{{url('auth/forgot-password-basic')}}">
                <small>Forgot Password?</small>
              </a> --}}
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="login-password"
                name="password"
                tabindex="2"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="login-password"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              @foreach ($errors->get('password') as $errorMessage)
              <span id="basic-default-name-error" class="error">{{ $errorMessage }}</span>
              @endforeach
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me" tabindex="3" />
              <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
        </form>

        <p class="text-center mt-2">
          <span>New on our platform?</span>
          <a href="{{url('register')}}">
            <span>Register Now</span>
          </a>
        </p>

      </div>
    </div>
    <!-- /Login basic -->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection
