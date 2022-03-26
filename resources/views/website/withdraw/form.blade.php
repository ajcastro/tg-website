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
    <form id="withdraw-form" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        <div class="mb-1">
            <label class="form-label" for="recepient-bank">Recipient Bank</label>
            <select class="form-select" id="recepient-bank" required name="recipient_bank_id">
                <option value="">- Select Bank -</option>
                @foreach (auth()->user()->banks as $bank)
                    <option value="{{$bank->id}}">{{$bank->account_code}} - {{$bank->account_number}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please enter your recipient bank</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="withdraw-account_name">Account Name</label>
            <input
                type="text"
                id="withdraw-account_name"
                class="form-control"
                placeholder=""
                required
                name="account_name"
                readonly
            />
            <div class="invalid-feedback">Please enter your account name</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="withdraw-account_number">Account Number</label>
            <input
                type="text"
                id="withdraw-account_number"
                class="form-control"
                placeholder=""
                required
                name="account_number"
                readonly
            />
            <div class="invalid-feedback">Please enter your account number</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="withdraw-amount">Amount</label>
            <input
                type="number"
                id="withdraw-amount"
                class="form-control"
                placeholder="Total Deposit"
                required
                name="amount"
            />
            <div class="invalid-feedback">Please enter withdraw amount.</div>
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
        $('#withdraw-form').on('submit', function (e) {
            var form = this;
            if (!form.checkValidity()) return;

            $.ajax({
                url: "/withdraw",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false
            }).done(function(d) {
                $(form).removeClass('was-validated')
                $(form).removeClass('invalid')
                form.reset()
                window.swalSuccess('Withdraw is successful!');
                var modal = bootstrap.Modal.getInstance(document.querySelector('#withdrawModal'));
                modal.hide();
                window.setFormErrors($(form), []);
            }).fail(function (e) {
                $(form).removeClass('was-validated')
                window.setFormErrors($(form), e.responseJSON.errors);
            });
        });

        $('#recepient-bank').on('change', function () {
            var banks = {!! auth()->user()->banks->toJson() !!};
            var selectedBankId = $(this).val();
            var selectedBank = banks.find(function (b) {
                return b.id == selectedBankId;
            });

            $('#withdraw-account_number').val(selectedBank.account_number);
            $('#withdraw-account_name').val(selectedBank.account_name);
        });
    });
</script>
@endpush
