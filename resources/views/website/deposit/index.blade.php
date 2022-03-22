@extends('layouts/contentLayoutMaster')

@section('title', 'Deposit')

@include('website.deposit.style')
@include('website.deposit.script')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="py-2 d-flex justify-content-end">
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#depositModal"
      >
        Create
      </button>
    </div>
  </div>
  @include('website.deposit.modal')
  @include('website.deposit.datatable')
</div>
@endsection
