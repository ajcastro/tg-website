@extends('layouts/contentLayoutMaster')

@section('title', 'Help')

@section('page-style')
  {{-- Page Css files --}}
<link href="//cdn.quilljs.com/1.3.7/quill.core.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.bubble.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row" style="margin-top: 30px;">
  <div class="col-xs-12 col-sm-12 col-md-3">
    <div class="card">
      <div class="card-body">
        <div class="list-group">
        @foreach ($categories as $category)
        <a href="{{ route('helps', ['category' => $category]) }}"
          class="list-group-item list-group-item-action {{ $activeCategory === $category ? 'active' : '' }}">
          {{ $category }} </a>
        @endforeach
      </div>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-9">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> {{ $activeCategory }} </h4>
      </div>
      <div class="card-body">
        <div class="accordion accordion-margin" id="accordionMargin">
          @foreach ($guides as $guide)
            <div class="accordion-item">
              <h2 class="accordion-header" id="{{ 'headingMargin'.$guide->id }}">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#{{ 'accordionMargin'. $guide->id }}"
                  aria-expanded="false"
                  aria-controls="{{ 'accordionMargin'. $guide->id }}"
                >
                  {{ $guide->title }}
                </button>
              </h2>
              <div
                id="{{ 'accordionMargin'. $guide->id }}"
                class="accordion-collapse collapse"
                aria-labelledby="{{ 'headingMargin'.$guide->id }}"
                data-bs-parent="#accordionMargin"
              >
                <div class="accordion-body">
                  <div class="ql-editor">
                    {!! $guide->getContent() !!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@if ($page)
<div class="ql-editor">
  {!! $page->content !!}
</div>
@endif
@endsection

@section('vendor-script')
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/components/components-accordion.js'))}}"></script>
@endsection
