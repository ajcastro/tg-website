@extends('layouts/contentLayoutMaster')

@section('title', current_website()->setting->title . ' | '. $page->short_description)

@section('page-style')
  {{-- Page Css files --}}

<link href="//cdn.quilljs.com/1.3.7/quill.core.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet" />
<link href="//cdn.quilljs.com/1.3.7/quill.bubble.css" rel="stylesheet" />
@endsection

@section('content')
<div class="ql-editor">
    {!! $page->content !!}
</div>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@endsection
