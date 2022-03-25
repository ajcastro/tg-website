@push('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endpush

@push('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endpush

<section class="bs-validation">
    <form id="change-password-form" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-1">
            <label class="d-block form-label" for="change-pass-old_password">Old Password</label>
            <input
                type="password"
                id="change-pass-old_password"
                class="form-control"
                placeholder=""
                required
                name="old_password"
            />
            <div class="invalid-feedback">Please enter your old password</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="change-pass_new_password">New Password</label>
            <input
                type="password"
                id="change-pass_new_password"
                class="form-control"
                placeholder=""
                required
                name="new_password"
            />
            <div class="invalid-feedback">Please enter your new password</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="change-pass_password_confirmation">Confirm Password</label>
            <input
                type="password"
                id="change-pass_password_confirmation"
                class="form-control"
                placeholder=""
                required
                name="new_password_confirmation"
            />
            <div class="invalid-feedback">Please enter your password confirmation</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>

@push('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endpush
@push('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
<script>
    $(function () {
        $('#change-password-form').on('submit', function (e) {
            var form = this;
            if (!form.checkValidity()) return;

            $(form).removeClass('was-validated')

            $.ajax({
                url: "/change_password",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false
            }).done(function(d) {
                $(form).removeClass('was-validated')
                $(form).removeClass('invalid')
                form.reset()
                window.swalSuccess('Change Password is successful!');
                var modal = bootstrap.Modal.getInstance(document.querySelector('#changePasswordModal'));
                modal.hide();
                window.setFormErrors($(form), []);
            }).fail(function (e) {
                $(form).removeClass('was-validated')
                window.setFormErrors($(form), e.responseJSON.errors);
            });
        })
    })
</script>
@endpush
