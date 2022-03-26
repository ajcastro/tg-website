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
    <form id="member-bank-form" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        @php
        $banks = \App\Models\Bank::getBanksOfCurrentWebsite();
        @endphp
        <div class="mb-1">
            <label class="form-label" for="member_bank-bank_account_code">Bank</label>
            <select class="form-select" id="member_bank-bank_account_code" required name="account_code">
                <option value="">- Select Bank -</option>
                @foreach ($banks as $bank)
                    <option value="{{$bank->code}}">{{$bank->code}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bank</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="member_bank-account_number">Account Number</label>
            <input
                type="text"
                id="member_bank-account_number"
                class="form-control"
                placeholder=""
                required
                name="account_number"
            />
            <div class="invalid-feedback">Please enter your account number</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="member_bank-account_name">Account Name</label>
            <input
                type="text"
                id="member_bank-account_name"
                class="form-control"
                placeholder=""
                required
                name="account_name"
                readonly
            />
            <div class="invalid-feedback">Please enter your account name</div>
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
        $('#memberBankModal').on('shown.bs.modal', function () {
            $.ajax({
                url: "/member_banks",
                type: 'GET',
            }).done(function (memberBanks) {
                var memberBank = memberBanks[0];
                $('#member_bank-account_name').val(memberBank.account_name);
            });
        });

        $('#member-bank-form').on('submit', function (e) {
            var form = this;
            if (!form.checkValidity()) return;

            $.ajax({
                url: "/member_banks",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false
            }).done(function(memberBank) {
                $(form).removeClass('was-validated')
                $(form).removeClass('invalid')
                form.reset()
                window.swalSuccess('Bank is successfully added!');
                var modal = bootstrap.Modal.getInstance(document.querySelector('#memberBankModal'));
                modal.hide();
                window.setFormErrors($(form), []);

                $('#deposit-form').trigger('member_bank_added', [memberBank]);
            }).fail(function (e) {
                $(form).removeClass('was-validated')
                window.setFormErrors($(form), e.responseJSON.errors);
            });
        })
    })
</script>
@endpush
