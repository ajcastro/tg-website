@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

<section class="bs-validation">
    <form class="needs-validation" novalidate>
        <div class="mb-1">
            <label class="form-label" for="select-country1">Bank</label>
            <select class="form-select" id="bankSender" required>
                <option value="">Select Bank</option>
            </select>
            <div class="invalid-feedback">Please select bank</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="basic-addon-name">Account Number</label>
            <input
                type="text"
                id="totalDeposit"
                class="form-control"
                placeholder="Total Deposit"
                aria-label="Name"
                aria-describedby="basic-addon-name"
                required
            />
            <div class="invalid-feedback">Please enter your total deposit.</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="basic-addon-name">Account Name</label>
            <input
                type="text"
                id="totalDeposit"
                class="form-control"
                placeholder="Total Deposit"
                aria-label="Name"
                aria-describedby="basic-addon-name"
                required
            />
            <div class="invalid-feedback">Please enter your total deposit.</div>
        </div>

        <div class="">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</section>

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
