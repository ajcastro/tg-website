@extends('layouts/contentLayoutMaster')

@section('title', 'Banks')

@include('website.banks.style')
@include('website.banks.script')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="py-2 d-flex justify-content-end">
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#banksModal"
      >
        Add
      </button>
    </div>
  </div>
  @include('website.banks.modal')
  @include('website.banks.datatable')
</div>
@endsection
