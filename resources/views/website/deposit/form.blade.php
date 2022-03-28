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
            <a data-bs-toggle="modal"
                data-bs-target="#memberBankModal"
                href="javascript:void(0)"
                class="ms-1">
                <span>{{__('Add Bank')}}</span>
            </a>
            <select class="form-select" id="bank-sender" required name="account_sender_id">
                <option value="">- Select Bank -</option>
                @foreach (auth()->user()->banks as $bank)
                    <option value="{{$bank->id}}">{{$bank->account_code}} - {{$bank->account_number}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bank sender</div>
        </div>

        @php
        $companyBanks = \App\Models\CompanyBank::getCompanyBanksOfCurrentWebsite('deposit');
        @endphp
        <div class="mb-1">
            <label class="form-label" for="bank-destination">Bank Destination</label>
            <select class="form-select" id="bank-destination" required name="bank_destination_id">
                <option value="">- Select Bank -</option>
                @foreach ($companyBanks as $companyBank)
                    <option value="{{$companyBank->id}}">{{$companyBank->bank_code}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bank destination</div>
        </div>

        <div id="bank-destination-info" class="alert alert-warning d-none" role="alert">
            <div class="alert-body">
                <table>
                    <tr>
                        <td class="td-label">Account Number</td>
                        <td class="td-value-account-number"></td>
                    </tr>
                    <tr>
                        <td class="td-label">Account Name</td>
                        <td class="td-value-account-name"></td>
                    </tr>
                    <tr>
                        <td class="td-label">Min</td>
                        <td class="td-value-min"></td>
                    </tr>
                    <tr>
                        <td class="td-label">Max</td>
                        <td class="td-value-max"></td>
                    </tr>
                </table>
            </div>
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
            <div class="invalid-feedback">Please enter amount within the range.</div>
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
                @php
                    $promotions = \App\Models\Promotion::getPromotionsOfCurrentWebsite(auth()->user());
                @endphp
                @foreach ($promotions->filter(function ($promotion) {
                    return empty($promotion->setting->min_deposit)
                        || $promotion->setting->min_deposit <= 0;
                }) as $promo)
                    <option value="{{$promo->id}}">{{ $promo->title }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select bonus</div>
        </div>

        <div class="mb-1">
            <label for="screenshot-deposit" class="form-label">Proof Deposit</label>
            <input class="form-control" type="file" id="screenshot-deposit" name="screenshot" />
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
        function filterBonusDropdown(amount) {
            var promotions = {!! $promotions->toJson() !!};
            return promotions.filter(function (promotion) {
                return parseFloat(amount) >= parseFloat(promotion.setting.min_deposit);
            });
        }

        function updateBonusDropdown(promotions) {
            $('#bonus').html('<option value="">- Select Bonus -</option>');
            $(promotions).each(function (index, promotion) {
                $('#bonus').append(
                    '<option value="'+promotion.id+'">' + promotion.title +'</option>'
                );
            });
        }

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
                $('#bank-destination-info').addClass('d-none');
            }).fail(function (e) {
                $(form).removeClass('was-validated')
                window.setFormErrors($(form), e.responseJSON.errors);
            });
        });

        $('#deposit-form').on('member_bank_added', function (e, memberBank) {
            $('#bank-sender').append(
                '<option value="'+memberBank.id+'">' +memberBank.account_code +' - '+ memberBank.account_number+
                '</option>'
            );
        });

        $('#bank-destination').on('change', function () {
            var selectedCompanyBankId = $(this).val();
            var companyBanks = {!! $companyBanks->toJson() !!};
            var selectedCompanyBank = companyBanks.find(function (cb) {
                return cb.id == selectedCompanyBankId;
            });

            if (selectedCompanyBank) {
                $('#bank-destination-info').removeClass('d-none');
                $('#bank-destination-info .td-value-account-number').html(selectedCompanyBank.bank_acc_no);
                $('#bank-destination-info .td-value-account-name').html(selectedCompanyBank.bank_acc_name);
                $('#bank-destination-info .td-value-min').html(selectedCompanyBank.min_amount);
                $('#bank-destination-info .td-value-max').html(selectedCompanyBank.max_amount);
                $('#total-deposit').attr('min', selectedCompanyBank.min_amount);
                $('#total-deposit').attr('max', selectedCompanyBank.max_amount);
            } else {
                $('#bank-destination-info').addClass('d-none');
            }
        });

        $('#bank-sender').on('change', function () {
            var banks = {!! auth()->user()->banks->toJson() !!};
            var selectedBankId = $(this).val();
            var selectedBank = banks.find(function (b) {
                return b.id == selectedBankId;
            });

            $('#description').val(selectedBank.account_name+' / '+selectedBank.account_number);
        });

        $('#total-deposit').on('input', function () {
            const amount = $(this).val()
            var promotions = filterBonusDropdown(amount);
            updateBonusDropdown(promotions);
        });
    })
</script>
@endpush

@push('page-style')
<style>
#bank-destination-info table td.td-label::after {
    content: ':';
    float: right;
    margin-left: 5px;
    margin-right: 5px;
}
</style>
@endpush
