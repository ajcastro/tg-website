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
    <form id="deposit-form" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <div class="mb-1">
            <label class="form-label" for="bank-sender">Bank Sender</label>
            <select class="form-select" id="bank-sender" required name="account_sender_id">
                <option value="">- Select Bank -</option>
                @foreach (auth()->user()->banks as $bank)
                    <option value="{{$bank->id}}">{{$bank->account_code}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bank sender</div>
        </div>

        @php
        $banks = \App\Models\Bank::getBanksOfCurrentWebsite();
        @endphp
        <div class="mb-1">
            <label class="form-label" for="bank-destination">Bank Destination</label>
            <select class="form-select" id="bank-destination" required name="bank_destination_id">
                <option value="">- Select Bank -</option>
                @foreach ($banks as $bank)
                    <option value="{{$bank->id}}">{{$bank->code}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bank destination</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="total-deposit">Total Deposit</label>
            <input
                type="number"
                id="total-deposit"
                class="form-control"
                placeholder="Total Deposit"
                required
                name="total_deposit"
            />
            <div class="invalid-feedback">Please enter your total deposit.</div>
        </div>

        <div class="mb-1">
            <label class="d-block form-label" for="description">Description</label>
            <input
                type="text"
                id="description"
                class="form-control"
                placeholder=""
                required
                name="description"
            />
            <div class="invalid-feedback">Please enter your description</div>
        </div>

        <div class="mb-1">
            <label class="form-label" for="bonus">Bonus</label>
            <select class="form-select" id="bonus" name="promotion_id">
                <option value="">- Select Bonus -</option>
                @foreach (\App\Models\Promotion::getPromotionsOfCurrentWebsite() as $promo)
                    <option value="{{$promo->id}}">{{ $promo->title }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bonus</div>
        </div>

        <div class="mb-1">
            <label for="screenshot-deposit" class="form-label">Proof Deposit</label>
            <input class="form-control" type="file" id="screenshot-deposit" required name="screenshot" />
            <div class="invalid-feedback">Please upload your proof of deposit</div>
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
        $('#deposit-form').on('submit', function (e) {
            var form = this;
            if (!form.checkValidity()) return;

            $.ajax({
                url: "/deposit",
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false
            }).done(function(d) {
                $(form).removeClass('was-validated')
                $(form).removeClass('invalid')
                form.reset()
                window.swalSuccess('Deposit is successful!');
                var modal = bootstrap.Modal.getInstance(document.querySelector('#depositModal'));
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
