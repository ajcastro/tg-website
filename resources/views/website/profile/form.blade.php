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
    <form id="profile-form" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-1">
            <label class="d-block form-label" for="profile-email">Username</label>
            <input
                type="text"
                id="profile-username"
                class="form-control"
                placeholder=""
                required
                name="username"
            />
            <div class="invalid-feedback">Please enter your username</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="profile-email">Email</label>
            <input
                type="text"
                id="profile-email"
                class="form-control"
                placeholder=""
                required
                name="email"
            />
            <div class="invalid-feedback">Please enter your email</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="profile-phone_number">Phone Number</label>
            <input
                type="text"
                id="profile-phone_number"
                class="form-control"
                placeholder=""
                required
                name="phone_number"
            />
            <div class="invalid-feedback">Please enter your phone number</div>
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
        $('#profileModal').on('shown.bs.modal', function () {
            $.ajax({
                url: "/profile",
                type: 'GET',
            }).done(function (data) {
                $('#profile-username').val(data.username)
                $('#profile-email').val(data.email)
                $('#profile-phone_number').val(data.phone_number)
            });
        });

        $('#profile-form').on('submit', function (e) {
            var form = this;
            if (!form.checkValidity()) return;

            $.ajax({
                url: "/profile",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false
            }).done(function(d) {
                $(form).removeClass('was-validated')
                $(form).removeClass('invalid')
                form.reset()
                window.swalSuccess('Updating profile is successful!');
                var modal = bootstrap.Modal.getInstance(document.querySelector('#profileModal'));
                modal.hide();
            }).fail(function (e) {
                alert('Something went wrong! Please try again.');
            });
        })
    })
</script>
@endpush
