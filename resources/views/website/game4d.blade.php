@php
$markets =  \App\Models\Market::withLatestGameMarketResult()->get()->filter(fn ($market) => $market->latestGameMarketResult);
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
{{-- TODO: Make the margin responsive, disable the margin on sm and xs screen --}}
<div class="row" style="margin-left: 150px; margin-right: 150px;">
  @foreach ($markets as $market)
    <div class="col-md-6 col-lg-3" style="">
      <div class="card">
        <div class="card-body text-center">
          <img class="img-fluid my-2" src="{{asset('images/slider/06.jpg')}}" width="80px" alt="" />
          <h4 class="card-title"> {{ $market->name }} </h4>
          <p class="card-text">
            {{$market->latestGameMarketResult->market_period->format('l') ?? '' }} <br>
            {{$market->latestGameMarketResult->market_period->format('d F, Y') ?? '' }}
          </p>
          <p class="h1 text-white"> {{$market->latestGameMarketResult->market_result ?? '' }} </p>
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
