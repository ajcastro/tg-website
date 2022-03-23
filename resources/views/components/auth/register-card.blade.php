@push('component-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endpush

<div class="auth-wrapper auth-basic px-2" style="min-height: 625px;">
  <div class="auth-inner my-2">
    <!-- Register basic -->
    <div class="card mb-0">
      <div class="card-body">
        <h4 class="card-title mb-1">Register</h4>

        <form class="auth-register-form mt-2" action="/register" method="POST">
          @csrf

          <div class="mb-1">
            <label for="register-username" class="form-label">Username</label>
            <input
              type="text"
              class="form-control"
              id="register-username"
              name="username"
              placeholder="username"
              aria-describedby="register-username"
              tabindex="1"
              autofocus
              value="{{ old('username') }}"
            />
            <x-input-errors :messages="$errors->get('username')" />
          </div>
          <div class="mb-1">
            <label for="register-email" class="form-label">Email</label>
            <input
              type="text"
              class="form-control"
              id="register-email"
              name="email"
              placeholder="email"
              aria-describedby="register-email"
              tabindex="2"
              value="{{ old('email') }}"
            />
            <x-input-errors :messages="$errors->get('email')" />
          </div>

          <div class="mb-1">
            <label for="register-password" class="form-label">Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="register-password"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="register-password"
                tabindex="3"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              <x-input-errors :messages="$errors->get('password')" />
            </div>
          </div>

          <div class="mb-1">
            <label for="confirm-password" class="form-label">Confirm Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="confirm-password"
                name="password_confirmation"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="confirm-password"
                tabindex="4"
              />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>

          <div class="mb-1">
            <label for="register-referral_number" class="form-label">Referral Number</label>
            <input
              type="text"
              class="form-control"
              id="register-referral_number"
              name="referral_number"
              placeholder=""
              aria-describedby="register-referral_number"
              tabindex="1"
              autofocus
              value="{{ old('referral_number') }}"
            />
            <x-input-errors :messages="$errors->get('username')" />
          </div>

          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="register-privacy-policy" tabindex="4" name="i_agree" />
              <label class="form-check-label" for="register-privacy-policy">
                {{ __('I am 18 years old and have agreed to the') }} <br>
                <a href="#">
                  {{__('terms and conditions')}}
                </a>.
              </label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="5">{{__('Sign up')}}</button>
        </form>

        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{url('/')}}">
            <span>{{__('Login instead')}}</span>
          </a>
        </p>


      </div>
    </div>
    <!-- /Register basic -->
  </div>
</div>

@push('component-script')
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endpush
