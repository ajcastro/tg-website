@php
$markets =  \App\Services\Game4D\Market::getDisplayableMarkets();
@endphp

@extends('layouts/contentLayoutMaster')

@section('title', current_website()->setting->title . ' | '. $page->short_description)

@section('page-style')
  {{-- Page Css files --}}

<link href="//cdn.quilljs.com/1.3.7/quill.core.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.bubble.css" rel="stylesheet" />
@endsection

@section('content')
<div class="mt-3"></div>
<div class="row mx-3 mx-md-5 px-md-4" style="">
  @foreach ($markets as $market)
    <div class="col-md-6 col-lg-3" style="">
      <div class="card">
        <div class="card-body text-center">
          <a href="{{ auth()->user()->getLinkToOpenGame4d() }}" target="_blank" class="text-white" >
            <img class="img-fluid my-2" src="{{ $market->flag_url }}" width="80px" alt="" />
            <h4 class="card-title"> {{ $market->name }} </h4>
            <p class="card-text">
              {{$market->date->format('l') ?? '' }} <br>
              {{$market->date->format('d F, Y') ?? '' }}
            </p>
            <p class="h1 text-white"> {{$market->result ?? '' }} </p>
          </a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@endsection
