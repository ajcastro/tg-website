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
            <label class="form-label" for="select-country1">Bank Sender</label>
            <select class="form-select" id="bankSender" required>
                <option value="">Select Sender</option>
            </select>
            <div class="invalid-feedback">Please select bank sender</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="select-country1">Bank Destination</label>
            <select class="form-select" id="bankDestination" required>
                <option value="">Select Destination</option>
            </select>
            <div class="invalid-feedback">Please select bank destination</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="basic-addon-name">Total Deposit</label>
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
            <label class="d-block form-label" for="validationBioBootstrap">Description</label>
            <textarea
                class="form-control"
                id="description"
                name="description"
                rows="3"
                required
            ></textarea>
            <div class="invalid-feedback">Please enter your description</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="select-country1">Bonus</label>
            <select class="form-select" id="bonus" required>
                <option value="">Select Bonus</option>
            </select>
            <div class="invalid-feedback">Please select bonus</div>
        </div>

        <div class="mb-1">
            <label for="customFile1" class="form-label">Proof Deposit</label>
            <input class="form-control" type="file" id="proofDeposit" required />
            <div class="invalid-feedback">Please upload your proof of deposit</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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
