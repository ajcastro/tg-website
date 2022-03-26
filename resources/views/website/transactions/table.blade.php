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

<section class="">
    <div class="table-responsive">
        <table id="transactions-table" class="table">
          <thead>
            <tr>
              <th>Ticket ID</th>
              <th>Date</th>
              <th>Type</th>
              <th>Amount</th>
              <th>Status</th>
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
        $('#transactionsModal').on('shown.bs.modal', function () {
            $.ajax({
                url: "/transactions",
                type: 'GET',
            }).done(function (rows) {
                $('#transactions-table tbody').html('');
                if (rows.length === 0) {
                  $('#transactions-table tbody').append(
                      '<tr>'+
                          '<td colspan="5" class="text-center"> No transactions record. </td>' +
                      '</tr>'
                  );
                }
                $(rows).each(function (index, row) {
                    $('#transactions-table tbody').append(
                        '<tr>'+
                            '<td>'+row.ticket_id+'</td>' +
                            '<td>'+row.date+'</td>' +
                            '<td>'+row.type+'</td>' +
                            '<td>'+row.amount+'</td>' +
                            '<td>'+row.status+'</td>' +
                        '</tr>'
                    );
                });
            });
        });
    })
</script>
@endpush
