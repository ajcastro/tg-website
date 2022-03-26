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
    <div id="profile-user-info" class="alert alert-info" role="alert">
        <div class="alert-body">
            <table>
                <tr>
                    <td class="td-label">Username</td>
                    <td class="td-value-username"></td>
                </tr>
                <tr>
                    <td class="td-label">Referral Code</td>
                    <td class="td-value-referral_code"></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="table-responsive">
        <table id="member-banks-table" class="table">
            <thead>
                <tr>
                    <th>Bank</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td colspan="5" class="text-center">
                    Loading...
                </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

@push('vendor-script')
@endpush

@push('page-script')
<!-- Page js files -->
<script>
    $(function () {
        $('#profileModal').on('shown.bs.modal', function () {
            $.ajax({
                url: "/profile",
                type: 'GET',
            }).done(function (data) {
                $('#profile-user-info .td-value-username').html(data.username)
                $('#profile-user-info .td-value-referral_code').html(data.referral_number)
            });

            $.ajax({
                url: "/member_banks",
                type: 'GET',
            }).done(function (memberBanks) {
                $('#member-banks-table tbody').html('');
                $(memberBanks).each(function (index, memberBank) {
                    $('#member-banks-table tbody').append(
                        '<tr>'+
                            '<td>'+memberBank.account_code+'</td>'+
                            '<td>'+memberBank.account_number+'</td>'+
                            '<td>'+memberBank.account_name+'</td>'+
                        '</tr>'
                    );
                });
            });
        });
    });
</script>
@endpush

@push('page-style')
<style>
#profile-user-info table td.td-label::after {
    content: ':';
    float: right;
    margin-left: 5px;
    margin-right: 5px;
}
</style>
@endpush
