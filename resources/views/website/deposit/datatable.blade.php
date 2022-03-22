<div class="col-12">
  <div class="card p-2">
    <table class="datatable-basic table">
      <thead>
        <tr>
          <th>Bank Sender</th>
          <th>Bank Destination</th>
          <th>Total Deposit</th>
          <th>Description</th>
          <th>Bonus</th>
          <th>Proof Deposit</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset('js/core/scripts.js') }}"></script>
@endsection
