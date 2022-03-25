@extends('layouts/contentLayoutMaster')

@section('title', 'Deposit')

@section('page-script')
<script>
  $(function () {
    $("#depositModal").modal('show');
  })
</script>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
      @include('website.deposit.modal')
  </div>
</div>
@endsection
